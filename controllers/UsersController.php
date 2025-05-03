<?php

namespace app\controllers;

use Yii;
use app\customs\FController;
use app\enums\BlockedStatus;
use app\enums\Role;
use app\models\RoleSearch;
use app\models\User;
use app\models\UserSearch;
use app\models\master\UnitSearch;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends FController
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->allowedRoles[0] = Role::ADMIN->value;
        $this->additionalDataClass = [
            'index' => ['roleList' => RoleSearch::class],
            'create' => [
                'roleList' => RoleSearch::class,
                'unitList' => UnitSearch::class
            ],
            'update' => [
                'roleList' => RoleSearch::class,
                'unitList' => UnitSearch::class
            ],
        ];
        $this->modelClass = User::class;
        $this->searchModelClass = UserSearch::class;
        $this->title = 'user';
        $this->enableCsrfValidation = true;
    }
    
    /**
     * @inheritdoc
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tempPassword = $model->password;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->password == '') {
                    $model->password = $tempPassword;
                }

                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $data = [
                    'model' => $model,
                    'title' => $this->title
                ];

                $data = $this->createAdditionalDatas($data, 'update');
                $model->password = '';

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->password = $model->password == '' ? $tempPassword :
                Yii::$app->getSecurity()->generatePasswordHash($model->password);
            
            if ($model->save()) {
                $flashMessage = Yii::t('app.form', $this->title);
                $flashMessage .= ' <strong>' . $model->name . '</strong> ';
                $flashMessage .= Yii::t('app.form', '.updated');

                Yii::$app->session->setFlash('success', $flashMessage);

                return $this->redirect(['index']);
            }
        }
    }

    /**
     * Lock/unlock an existing User model.
     * If lock/unlock is successful, the system will return success message.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws UnprocessableEntityHttpException if the action cannot be executed
     */
    public function actionLock($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->is_blocked == BlockedStatus::IS_BLOCKED->value) {
            $model->is_blocked = BlockedStatus::IS_NOT_BLOCKED->value;
        } else {
            $model->is_blocked = BlockedStatus::IS_BLOCKED->value;
        }

        if (! $model->save()) {
            throw new yii\web\UnprocessableEntityHttpException('Failed');
        }

        $flashMessage = Yii::t('app.form', $this->title);
        $flashMessage .= ' <strong>' . $model->name . '</strong> ';
        $flashMessage .= Yii::t('app.form', '.updated');

        Yii::$app->session->setFlash('success', $flashMessage);

        return [
            'code' => 200,
            'message' => 'success'
        ];
    }
}
