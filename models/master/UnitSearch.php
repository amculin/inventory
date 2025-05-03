<?php

namespace app\models\master;

use Yii;
use app\enums\DeletedStatus;
use yii\helpers\ArrayHelper;

class UnitSearch extends Unit
{
    public static function getList()
    {
        $sql = "SELECT id, name FROM master_units WHERE is_deleted = :is_deleted";

        $data = Yii::$app->db->createCommand($sql, [
            ':is_deleted' => DeletedStatus::IS_NOT_DELETED->value
        ])->queryAll();

        return ArrayHelper::map($data, 'id', 'name');
    }
}
