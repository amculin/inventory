<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
$response = Yii::$app->response;
?>
<div class="error-container">
    <i class="bi bi-exclamation-circle error-icon"></i>
    <h1 class="error-heading"><?= $response->statusCode; ?></h1>
    <h2 class="error-subheading"><?= $response->statusText; ?></h2>
    <p class="lead">
        <?= $message; ?>
    </p>
    <a href="/" class="btn btn-home mt-3">Go to Homepage</a>
</div>