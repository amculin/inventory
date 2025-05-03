<?php

use app\assets\FormModalAsset;
use app\customs\FActionColumn;
use app\customs\FDeleteAlert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$fullTitle = Yii::t('app', $title . '.management')
?>

<div class="page-wrapper" data-menu-active="<?= $fullTitle; ?>" data-submenu-active="">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#"><?php echo $fullTitle; ?></a></li>
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
                    <a href="<?= Url::to('/users/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block modal-trigger"
                        data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        <?= Yii::t('app.form', Yii::t('app.form', 'create.' . $title)); ?>
                    </a>
                    <div class="ms-auto d-flex gap-2">
                        <?php
                        $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => ['style' => 'display: contents;']
                        ]);

                        echo $form->field($searchModel, 'role_id', ['options' => ['tag' => false]])->dropDownList($roleList, [
                            'prompt' => Yii::t('app.form', 'all.role'),
                            'class' => 'form-select',
                            'style' => 'width: 160px;',
                            'tag' => false
                        ])->label(false);
                        ?>
                        <div class="input-group">
                            <?= $form->field($searchModel, 'name', ['options' => ['tag' => false]])->textInput([
                                'placeholder' => Yii::t('app.form', 'search.data..'),
                                'tag' => false
                            ])->label(false); ?>
                            <?= Html::submitButton('<i class="bi bi-search"></i>', ['class' => 'btn']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
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
                                'urlCreator' => function ($action, array $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model['id']]);
                                },
                                'headerOptions' => ['width' => '10'],
                                'contentOptions' => [
                                    'class' => 'text-nowrap d-flex gap-2'
                                ],
                                'template' => '{update} {lock} {delete}',
                                'buttons' => [
                                    'lock' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => $model['is_blocked'] == 1 ? 'bi bi-unlock' : 'bi bi-lock',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => Yii::t('app', $model['is_blocked'] == 1 ? 'unlock' : 'lock')
                                        ]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-dark lock-user']);
                                    }
                                ],
                            ],
                            'username',
                            [
                                'header' => Yii::t('app.form', 'name'),
                                'value' => function ($data) {
                                    return $data['name'];
                                },
                            ],
                            'email',
                            [
                                'header' => Yii::t('app.form', 'role'),
                                'value' => function ($data) {
                                    return $data['role_name'];
                                },
                            ]
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

<div class="modal fade modal-blur users-form" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>

<?php
FormModalAsset::register($this);

$lockTitle = Yii::t('app', 'lock');
$unlockTitle = Yii::t('app', 'unlock');
$action = Yii::t('app.form', 'user');
$confirmationText = Yii::t('app.form', 'sure?');
$success = Yii::t('app.form', 'success');
$failed = Yii::t('app.form', 'failed');

$js = "
$('#w1 a.lock-user').click(function(event) {
    event.preventDefault();
    
    var url = $(this).attr('href');
    var title = $(this).find('i').attr('data-bs-original-title');
    var action = (title == 'Lock' || title == 'Kunci') ? '{$lockTitle}' : '{$unlockTitle}';
    var csrfToken = $('meta[name=\"csrf-token\"]').attr('content');

    Swal.fire({
        title: action + ' {$action}?',
        text: '{$confirmationText}',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: action + ' {$action}!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type : 'POST',
                data: {_csrf : csrfToken},
                success : function(data) {
                    location.reload();
                }
            });
        }
    })
});
";

$this->registerJs($js, $this::POS_END, 'user-lock-handler');
