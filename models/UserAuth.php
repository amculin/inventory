<?php

namespace app\models;

use Yii;
use app\enums\BlockedStatus;
use app\enums\DeletedStatus;
use yii\web\IdentityInterface;

class UserAuth extends User implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {}

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findUser($username)
    {
        return static::findOne([
            'username' => $username,
            'is_blocked' => BlockedStatus::IS_NOT_BLOCKED->value,
            'is_deleted' => DeletedStatus::IS_NOT_DELETED->value
        ]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
