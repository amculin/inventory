<?php

use app\customs\FActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$fullTitle = Yii::t('app', $title);
?>
<div class="page-wrapper" data-menu-active="<?= Yii::t('app', 'references'); ?>" data-submenu-active="<?= $fullTitle; ?>">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#"><?= Yii::t('app', 'references'); ?></a></li>
                            <li class="breadcrumb-item active"><a href="#"><?= $fullTitle; ?></a></li>
                        </ol>
                    </div>
                    <h2 class="page-title"><?= $fullTitle; ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <a href="<?= Url::to('/references/brands/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="bi bi-plus"></i>
                        <?= Yii::t('app.form', Yii::t('app.form', 'create.' . $title)); ?>
                    </a>
                </div>
                   
                <?php if (Yii::$app->session->hasFlash('success')) { ?>
                    <div class="m-3 alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= Yii::t('app.form', 'success'); ?>!</strong> <?= Yii::$app->session->getFlash('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="<?= Yii::t('app.form', 'close'); ?>"></button>
                    </div>
                <?php } ?>

                <div class="table-responsive card-body p-0">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => null,
                        'layout' => "{items}\n{pager}",
                        'tableOptions' => ['class' => 'table'],
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No',
                                'headerOptions' => ['width' => '5'],
                            ],
                            [
                                'class' => FActionColumn::className(),
                                'urlCreator' => function ($action, Array $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model['id']]);
                                },
                                'headerOptions' => ['width' => '10'],
                                'contentOptions' => [
                                    'class' => 'text-nowrap d-flex gap-2'
                                ],
                            ],
                            'code',
                            'name'
                        ],
                        'pager' => [
                            'class' => 'app\customs\FLinkPager',
                            'options' => ['class' => 'pagination ms-auto m-0'],
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'linkOptions' => ['class' => 'page-link'],
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
