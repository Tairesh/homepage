<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::$app->name . ' | ' . $name;
?>

<h1><?= Html::encode($name) ?></h1>

<p>
    <?= nl2br(Html::encode($message)) ?>
</p>
