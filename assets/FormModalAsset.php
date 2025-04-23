<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main layout asset bundle.
 *
 * @author Fahmi Auliya Tsani <amixcustomlinux@gmail.com>
 */
class FormModalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = ['js/form-modal-handler.js'];
    public $depends = ['app\assets\MainAsset'];
}
