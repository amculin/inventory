<?php

namespace app\models;

use Yii;
use app\models\master\Unit;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $unit_id
 * @property int $role_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $name
 * @property int $is_blocked 0 = False; 1 = True;
 * @property int $is_deleted 0 = False; 1 = True;
 * @property string $auth_key
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 *
 * @property CategoryReport[] $categoryReports
 * @property User $createdBy
 * @property InboundTransaction[] $inboundTransactions
 * @property MasterBrand[] $masterBrands
 * @property MasterCategory[] $masterCategories
 * @property MasterProduct[] $masterProducts
 * @property Unit[] $units
 * @property OutboundTransaction[] $outboundTransactions
 * @property Role $role
 * @property Role[] $roles
 * @property Stock[] $stocks
 * @property TransactionReport[] $transactionReports
 * @property User[] $users
 */
class User extends \yii\db\ActiveRecord
{
    const SCENARIO_NEW_USER = 'new-user';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'role_id', 'username', 'email', 'name'], 'required'],
            [['password'], 'required', 'on' => $this::SCENARIO_NEW_USER],
            [['unit_id', 'role_id', 'is_blocked', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 20],
            [['email'], 'email'],
            [['email', 'name', 'auth_key'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 64],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['unit_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.form', 'id'),
            'unit_id' => Yii::t('app.form', 'unit'),
            'role_id' => Yii::t('app.form', 'role'),
            'username' => Yii::t('app.form', 'username'),
            'email' => Yii::t('app.form', 'email'),
            'password' => Yii::t('app.form', 'password'),
            'name' => Yii::t('app.form', 'name'),
            'is_blocked' => Yii::t('app', 'is.blocked'),
            'is_deleted' => Yii::t('app', 'is.deleted'),
            'auth_key' => Yii::t('app.form', 'auth.key'),
            'created_at' => Yii::t('app.form', 'created.at'),
            'updated_at' => Yii::t('app.form', 'udated.at'),
            'created_by' => Yii::t('app.form', 'created.by'),
            'updated_by' => Yii::t('app.form', 'updated.by'),
        ];
    }

    /**
     * Gets query for [[CategoryReports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryReports()
    {
        return $this->hasMany(CategoryReport::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[InboundTransactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInboundTransactions()
    {
        return $this->hasMany(InboundTransaction::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[MasterBrands]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasterBrands()
    {
        return $this->hasMany(MasterBrand::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[MasterCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasterCategories()
    {
        return $this->hasMany(MasterCategory::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[MasterProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasterProducts()
    {
        return $this->hasMany(MasterProduct::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[MasterUnits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasterUnits()
    {
        return $this->hasMany(MasterUnit::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[OutboundTransactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutboundTransactions()
    {
        return $this->hasMany(OutboundTransaction::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[Roles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Stocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[TransactionReports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionReports()
    {
        return $this->hasMany(TransactionReport::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(MasterUnit::class, ['id' => 'unit_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['created_by' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $this->created_by = Yii::$app->user->identity->id;
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->identity->id;
        }

        return true;
    }
}
