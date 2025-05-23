<?php

namespace app\models\master;

use Yii;
use app\enums\DeletedStatus;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;

class BrandSearch extends Brand
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'string'],
            [['code', 'name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public static function getList()
    {
        $sql = "SELECT id, name FROM master_brands WHERE is_deleted = :is_deleted";

        $data = Yii::$app->db->createCommand($sql, [
            ':is_deleted' => DeletedStatus::IS_NOT_DELETED->value
        ])->queryAll();

        return ArrayHelper::map($data, 'id', 'name');
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $bound = [':status' => DeletedStatus::IS_NOT_DELETED->value];
        $where = ' WHERE b.is_deleted = :status';

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM master_brands b' . $where, $bound)->queryScalar();
        $sql = "SELECT b.* FROM master_brands b
        {$where}";

        $config = [
            'sql' => $sql,
            'params' => $bound,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
        ];

        return new SqlDataProvider($config);
    }
}
