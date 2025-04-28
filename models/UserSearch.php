<?php

namespace app\models;

use Yii;
use app\enums\DeletedStatus;
use app\models\User;
use yii\base\Model;
use yii\data\SqlDataProvider;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unit_id', 'role_id', 'is_blocked', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['username', 'email', 'password', 'name', 'auth_key', 'created_at', 'updated_at'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $filters = [];
        $bound = [':status' => DeletedStatus::IS_NOT_DELETED->value];
        $where = ' WHERE u.is_deleted = :status';

        $this->load($params);

        if ($this->role_id) {
            $filters[] = 'u.role_id = :roleID';
            $bound[':roleID'] = $this->role_id;
        }

        if ($this->name) {
            $filters[] = '(u.username LIKE :name OR u.name LIKE :name OR u.email LIKE :name)';
            $bound[':name'] = "%{$this->name}%";
        }

        if (! empty($filters)) {
            $where .= ' AND ' . implode(' AND ', $filters);
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM users u' . $where, $bound)->queryScalar();
        $sql = "SELECT u.id, u.role_id, u.username, u.name, u.email, u.is_blocked, r.name AS role_name  FROM users u
            LEFT JOIN roles r ON (r.id = u.role_id)
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
