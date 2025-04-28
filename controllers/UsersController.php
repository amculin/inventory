<?php

namespace app\controllers;

use Yii;
use app\customs\FController;
use app\enums\Role;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends FController
{

    public function init()
    {
        parent::init();

        $this->allowedRoles[0] = Role::ADMIN->value;
        $this->additionalDataClass = [
            'index' => ['roleList' => 'app\models\RoleSearch']
        ];
        $this->modelClass = 'app\models\User';
        $this->searchModelClass = 'app\models\UserSearch';
        $this->title = 'user';
        $this->enableCsrfValidation = true;
    }
}
