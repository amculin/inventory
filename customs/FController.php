<?php
namespace app\customs;

use Yii;
use app\enums\DeletedStatus;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Custom version of yii\web\Controller to handle all basic action
 * Basic action/method handled by this class:
 * - Index & Search
 * - Create: AJAX validation, AJAX modal form, data submission
 * - Update: AJAX validation, AJAX modal form, data submission
 * - Delete: AJAX soft deletion
 * - Find Model: finding single data by it's ID
 *
 * @author Fahmi Auliya Tsani <amixcustomlinux@gmail.com>
 */
class FController extends Controller
{
    public $additionalDataClass;
    public $allowedRoles;
    public $modelClass;
    public $searchModelClass;
    public $title;
    public $specialRules;

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
                ['access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                if (Yii::$app->user->isGuest) {
                                    $isAllowed = !$rule->allow;
                                    $logMessage = PHP_EOL . '    Guest';
                                } else {
                                    $logMessage = PHP_EOL . '    Username ' . Yii::$app->user->identity->username;
                                    $logMessage .= ' (' . Yii::$app->session->get('user_data')['role_name'] . ')';

                                    if (isset($this->specialRules)) {
                                        $isAllowed = $this->specialAccess($action->id, $this->specialRules);
                                    } else {
                                        $isAllowed = in_array(Yii::$app->user->identity->role_id, $this->allowedRoles);
                                    }
                                }

                                $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                                $logMessage .= ' tried to access ' . $this::class . '\\' . $action->actionMethod . PHP_EOL;
                                $logMessage .= '    with URL: ' . $url . ' from ' . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
                                $logMessage .= '    Access is ' . strtoupper($isAllowed ? 'GRANTED!' : 'DENIED!');

                                Yii::info($logMessage, 'Auth Checking');

                                return $isAllowed;
                            }
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Method to check whether current action is matched with defined special rules
     *
     * @param string $action current accessed action
     * @param array $rules list of pre-defined special rules
     * @return bool
     */
    public function specialAccess(string $action, array $rules): bool
    {
        if (in_array($action, $rules)) {
            return in_array(Yii::$app->user->identity->role_id, $rules[$action]);
        } else {
            return true;
        }
    }

    /**
     * Create any additional datas to be rendered into view
     *
     * @param array $data current array of data to be sent to the view
     * @param string $action current action
     * @return array
     */
    public function createAdditionalDatas(array $data, string $action): array
    {
        if (isset($this->additionalDataClass) && array_key_exists($action, $this->additionalDataClass)) {
            foreach ($this->additionalDataClass[$action] as $key => $val) {
                $data[$key] = ($val)::getList();
            }
        }

        return $data;
    }

    /**
     * Lists all data from model.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ($this->searchModelClass)();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $data = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

        $data = $this->createAdditionalDatas($data, 'index');

        return $this->render('index', $data);
    }

    /**
     * Creates a new model.
     * If request comes in AJAX, it will render the form or do the validation.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ($this->modelClass)();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $data = [
                    'model' => $model,
                    'title' => 'Tambah ' . $this->title
                ];

                $data = $this->createAdditionalDatas($data, 'create');

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }
    }

    /**
     * Updates an existing model.
     * If request comes in AJAX, it will render the form or do the validation.
     * If update is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $data = [
                    'model' => $model,
                    'title' => 'Edit ' . $this->title
                ];

                $data = $this->createAdditionalDatas($data, 'edit');

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);
        $model->is_deleted = DeletedStatus::IS_DELETED->value;

        if (! $model->save()) {
            throw new yii\web\UnprocessableEntityHttpException('Gagal');
        }

        return [
            'code' => 200,
            'message' => 'Sukses'
        ];
    }

    /**
     * Find the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     * @return \yii\db\ActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ($this->modelClass)::findOne([
            'id' => $id,
            'is_deleted' => DeletedStatus::IS_NOT_DELETED->value
        ])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
