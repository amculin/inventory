<?php
namespace app\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'app\models\User';
    public $depends = [
        'app\fixtures\RoleFixture',
        'app\fixtures\MasterUnitFixture',
    ];
}
