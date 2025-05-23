<?php

namespace app\modules\references\controllers;

use Yii;
use app\customs\FController;
use app\enums\Role;
use app\models\master\Unit;
use app\models\master\UnitSearch;

/**
 * UnitsController implements the CRUD actions for Unit model.
 */
class UnitsController extends FController
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->allowedRoles[0] = Role::ADMIN->value;
        $this->modelClass = Unit::class;
        $this->searchModelClass = UnitSearch::class;
        $this->title = 'unit';
        $this->enableCsrfValidation = true;
    }
}
