<?php
namespace app\fixtures;

use yii\test\ActiveFixture;

class MasterUnitFixture extends ActiveFixture
{
    public $modelClass = 'app\models\master\Unit';
    public $dataFile = __DIR__ . '/data/master_units.php';
}
