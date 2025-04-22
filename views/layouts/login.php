<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\LoginAsset;
use yii\bootstrap5\Html;
use yii\web\View;

LoginAsset::register($this);
$this->beginPage();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title><?= Html::encode(Yii::t('app', Yii::$app->params['appName'])); ?></title>
        <link rel="shortcut icon" href="image/fitfat.id.png">
        <!-- CSS files -->
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column flex-md-row page-login">
    <?php $this->beginBody() ?>
        <div class="login-cover bg-dark col d-flex align-items-end order-md-last swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="image/inventory-1-1176210-pxhere.com.jpg" alt="Inventory" class="cover" />
                </div>
                <div class="swiper-slide">
                    <img src="image/inventory-2-940710-pxhere.com.jpg" alt="Helmet Store" class="cover" />
                </div>
                <div class="swiper-slide">
                    <img src="image/inventory-3-1454387-pxhere.com.jpg" alt="Meeting" class="cover" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"><i class="bi bi-arrow-left-circle text-white fs-1"></i></div>
            <div class="swiper-button-next"><i class="bi bi-arrow-right-circle text-white fs-1"></i></div>
        </div>
        <div class="loginbox d-flex align-items-center justify-content-center col">
            <div class="box col-md-8 p-4">
                <?= $content; ?>
            </div>
        </div>
    </div>

    <!-- Modal Forgot Password -->
    <div class="modal fade modal-blur" id="modal-forgot-password" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= Yii::t('app.login', 'forgot.password'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="<?= Yii::t('app.form', 'close'); ?>"></button>
                </div>
                <div class="modal-body">
                    <?= Yii::t('app.login', 'forgot.password.line'); ?> <br /><br />
                    <div class="mb-2">
                        <label for="" class="form-label"><?= Yii::t('app.form', 'your.email'); ?></label>
                        <input type="email" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?= Yii::t('app.form', 'close'); ?>
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        <?= Yii::t('app.form', 'submit'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    $js = "
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            loop: true,
            effect: 'fade',
            speed:2000,
            autoplay: {
                delay: 5000,
            },

            // If we need pagination
            pagination: {
            el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    ";
    $this->registerJs(
        $js,
        View::POS_READY,
        'swiper-handler'
    );
    ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
