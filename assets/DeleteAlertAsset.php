<?php
namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Asset bundle to support delete confirmation alert.
 *
 * @author Fahmi Auliya Tsani <amixcustomlinux@gmail.com>
 */
class DeleteAlertAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = ['app\assets\MainAsset'];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->js = $this->isOnEnglish() ? ['js/delete-alert-handler-en.js']
            : ['js/delete-alert-handler.js'];
    }

    /**
     * Method to check whether current language is English or not
     *
     * @return bool
     */
    public function isOnEnglish(): bool
    {
        return Yii::$app->language == 'en-EN';
    }
}
