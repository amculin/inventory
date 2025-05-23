<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
use app\assets\DeleteAlertAsset;
use app\customs\FMenu;
use yii\bootstrap5\Html;
use yii\web\View;
use yii\widgets\Menu;

MainAsset::register($this);
DeleteAlertAsset::register($this);
$this->beginPage();

$userData = Yii::$app->session->get('user_data');
$words = explode(' ', Yii::$app->user->identity->name);
$acronym = '';

foreach ($words as $w) {
  $acronym .= substr($w, 0, 1);
}

$unit = $userData['code'] . ' (' . $userData['unit_name'] . ')';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(Yii::t('app', Yii::$app->params['appName'])); ?></title>
        <link rel="shortcut icon" href="/image/fitfat.id.png">
        <!-- CSS files -->
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <div class="page">
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark sidebar">
            <div class="container-fluid px-0 justify-content-start">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand text-white ms-3 ms-lg-0 gap-3">
                    <div class="logo">
                        <img src="/image/fitfat.id.png" alt="" height="15">
                    </div>
                    <a href="#" class="fw-bold hstack gap-3 text-decoration-none">
                        <div style="font-size: .8rem;"><?= Yii::t('app', Yii::$app->params['appName']); ?></div>
                    </a>
                </h1>
                <div class="text-center p-2 mb-1 bg-primary text-white">
                    Unit : <?= $unit; ?>
                </div>
                <div class="offcanvas offcanvas-start px-lg-3 bg-dark" id="sidebar-menu">
                    <div class="offcanvas-header">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="image">
                                <img src="/image/fitfat.id.png" alt="" height="15" />
                            </div>
                            <div class="logo-text flex-grow-1">
                                <div class="fs-4"><?= Yii::t('app', Yii::$app->params['appName']); ?></div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-3 p-lg-0 flex-column flex-grow-1 overflow-auto">
                        <?php
                        echo FMenu::widget();
                        ?>
                    </div>
                </div>
            </div>
        </aside>

        <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none sticky-top" id="navbar">
            <div class="container-xl justify-content">
                <button class="sidebar-toggler" type="button">
                    <span class="sidebar-icon"></span>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-nav flex-row order-md-last ms-md-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0 dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="bg-primary text-white avatar rounded-circle">
                            <?= $acronym; ?>
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div class="fw-bold"><?= $userData['role_name']; ?></div>
                                <div class="mt-1 small text-primary"><?= Yii::$app->user->identity->name; ?></div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="?page=profile" class="dropdown-item"><i class="bi bi-person me-2"></i> <?= Yii::t('app.form', 'My Profile'); ?></a>
                            <a href="#" class="dropdown-item"><i class="bi bi-key me-2"></i> <?= Yii::t('app.form', 'Change Password'); ?></a>
                            <div class="dropdown-divider"></div>
                            <?php
                            echo Html::beginForm(['/site/logout']);
                            echo Html::submitButton(
                                '<i class="bi bi-box-arrow-right me-2"></i> Logout',
                                ['class' => 'dropdown-item text-danger']
                            );
                            echo Html::endForm();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?= $content; ?>
        </div>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
