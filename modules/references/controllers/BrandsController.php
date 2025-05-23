<?php

namespace app\modules\references\controllers;

use Yii;
use app\customs\FController;
use app\enums\Role;
use app\models\master\Brand;
use app\models\master\BrandSearch;

/**
 * BrandsController implements the CRUD actions for Brand model.
 */
class BrandsController extends FController
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->allowedRoles = [Role::ADMIN->value];
        $this->modelClass = Brand::class;
        $this->searchModelClass = BrandSearch::class;
        $this->title = 'brands';
        $this->enableCsrfValidation = true;
    }
}
