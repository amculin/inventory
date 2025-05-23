<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$fullTitle = Yii::t('app', $title);
$formTitle = ($model->isNewRecord ? 'create' : 'update') . '.' . $title;
?>
<div class="page-wrapper" data-submenu-active="<?= $fullTitle; ?>" data-menu-active="<?= Yii::t('app', 'references'); ?>">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#"><?= Yii::t('app', 'references'); ?></a></li>
                            <li class="breadcrumb-item"><a href="<?= Url::to('/references/brands/index', true); ?>"><?php echo $fullTitle; ?></a></li>
                            <li class="breadcrumb-item active">
                                <a href="#"><?php echo Yii::t('app.form', Yii::t('app.form', $formTitle)); ?></a>
                            </li>
                        </ol>
                    </div>
                    <h2 class="page-title"><?= Yii::t('app.form', Yii::t('app.form', $formTitle)); ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <?php $form = ActiveForm::begin([
                'id' => 'references-brand-form',
                'enableAjaxValidation' => false
            ]); ?>
                <div class="row g-3">
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <?= $form->field($model, 'code', [
                                        'options' => ['class' => 'mb-2']
                                    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
                                <?= $form->field($model, 'name', [
                                        'options' => ['class' => 'mb-2']
                                    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2 justify-content-between">
                    <a href="<?= Url::to('/references/brands/index', true); ?>" class="btn btn px-4">
                        <i class="bi bi-arrow-left me-2"></i><?= Yii::t('app.form', 'back'); ?>
                    </a>
                    <button class="btn btn-primary px-4" type="submit"><?= Yii::t('app.form', 'save'); ?></button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
