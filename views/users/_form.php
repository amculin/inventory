<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var array $roleList */
/** @var array $unitList */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="modal-header">
    <h5 class="modal-title"><?= Yii::t('app.form', Yii::t('app.form', 'create.' . $title)); ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'user-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?= $form->field($model, 'role_id', [
            'options' => ['class' => 'mb-2']
        ])->dropDownList($roleList, ['prompt' => Yii::t('app.form', 'choose.role')])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'unit_id', [
            'options' => ['class' => 'mb-2']
        ])->dropDownList($unitList, ['prompt' => Yii::t('app.form', 'choose.unit')])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'email', [
            'options' => ['class' => 'mb-2']
        ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'username', [
            'options' => ['class' => 'mb-2']
        ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'password',[
            'options' => ['class' => 'mb-2']
        ])->passwordInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'name', [
            'options' => ['class' => 'mb-2']
        ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app.form', 'close'); ?></button>
    <button type="submit" class="btn btn-primary"><?= Yii::t('app.form', 'submit'); ?></button>
</div>
<?php ActiveForm::end(); ?>