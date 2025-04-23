<?php
namespace app\customs;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Custom widget to generate sidebar menu
 *
 * @author Fahmi Auliya Tsani <amixcustomlinux@gmail.com>
 */
class FMenu extends Widget
{
    public function run()
    {
        $items = Yii::$app->params['menu'];
        $roleID = Yii::$app->user->identity->role_id;

        return $this->render('@app/customs/views/fmenu', [
            'menu' => $items,
            'roleID' => $roleID
        ]);
    }
}
