<?php

namespace app\controllers;

use Yii;
use app\customs\FController;
use app\enums\Role;

class DashboardController extends FController
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->allowedRoles = [Role::ADMIN->value, Role::WAREHOUSE->value, Role::CASHIER->value];
        $this->title = 'dashboard';
        $this->layout = 'main';
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
