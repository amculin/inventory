<?php

namespace app\models;

use Yii;
use app\enums\DeletedStatus;
use app\models\Role;
use yii\helpers\ArrayHelper;

/**
 * RoleSearch represents the model behind the search form of `app\models\Role`.
 */
class RoleSearch extends Role
{
    public static function getList()
    {
        $sql = "SELECT id, name
            FROM roles
            WHERE is_deleted = :is_deleted";

        $data = Yii::$app->db->createCommand($sql, [
            ':is_deleted' => DeletedStatus::IS_NOT_DELETED->value
        ])->queryAll();

        return ArrayHelper::map($data, 'id', 'name');
    }
}
