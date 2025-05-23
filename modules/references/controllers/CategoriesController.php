<?php

namespace app\modules\references\controllers;

use Yii;
use app\customs\FController;
use app\enums\Role;
use app\models\master\Category;
use app\models\master\CategorySearch;

/**
 * CategoriesController implements the CRUD actions for Category model.
 */
class CategoriesController extends FController
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->allowedRoles = [Role::ADMIN->value];
        $this->modelClass = Category::class;
        $this->searchModelClass = CategorySearch::class;
        $this->title = 'product.categories';
        $this->enableCsrfValidation = true;
    }
}
