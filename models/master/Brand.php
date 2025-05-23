<?php

namespace app\models\master;

use Yii;
use app\models\User;

/**
 * This is the model class for table "master_brands".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $is_deleted
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property MasterProduct[] $masterProducts
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'created_by'], 'required'],
            [['is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 20],
            ['code', 'unique'],
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
            'code' => Yii::t('app.form', 'code'),
            'name' => Yii::t('app.form', 'name'),
            'is_deleted' => Yii::t('app.form', 'Is Deleted'),
            'created_at' => Yii::t('app.form', 'Created At'),
            'updated_at' => Yii::t('app.form', 'Updated At'),
            'created_by' => Yii::t('app.form', 'Created By'),
            'updated_by' => Yii::t('app.form', 'Updated By'),
        ];
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
     * Gets query for [[MasterProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasterProducts()
    {
        return $this->hasMany(MasterProduct::class, ['brand_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->created_by = Yii::$app->user->identity->id;
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->identity->id;
        }

        return true;
    }
}
