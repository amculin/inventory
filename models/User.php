<?php

namespace app\models;

use Yii;

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
 * @property MasterUnit[] $masterUnits
 * @property OutboundTransaction[] $outboundTransactions
 * @property Role $role
 * @property Role[] $roles
 * @property Stock[] $stocks
 * @property TransactionReport[] $transactionReports
 * @property MasterUnit $unit
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
            [['unit_id', 'role_id', 'username', 'email', 'password', 'name', 'auth_key', 'created_by'], 'required'],
            [['unit_id', 'role_id', 'is_blocked', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 20],
            [['email', 'name', 'auth_key'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 64],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterUnit::class, 'targetAttribute' => ['unit_id' => 'id']],
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
            'id' => Yii::t('app.form', 'ID'),
            'unit_id' => Yii::t('app.form', 'Unit'),
            'role_id' => Yii::t('app.form', 'Peran'),
            'username' => Yii::t('app.form', 'Username'),
            'email' => Yii::t('app.form', 'Email'),
            'password' => Yii::t('app.form', 'Password'),
            'name' => Yii::t('app.form', 'Nama'),
            'is_blocked' => Yii::t('app.form', 'Is Blocked'),
            'is_deleted' => Yii::t('app.form', 'Is Deleted'),
            'auth_key' => Yii::t('app.form', 'Auth Key'),
            'created_at' => Yii::t('app.form', 'Created At'),
            'updated_at' => Yii::t('app.form', 'Updated At'),
            'created_by' => Yii::t('app.form', 'Created By'),
            'updated_by' => Yii::t('app.form', 'Updated By'),
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
}
