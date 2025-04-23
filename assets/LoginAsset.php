<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Login layout asset bundle.
 *
 * @author Fahmi <amixcustomlinux@gmail.com>
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/login.css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css'
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
