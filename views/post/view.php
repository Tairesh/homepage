<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title . ' | ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => $model->title ? $model->title : "post #{$model->id}"];

?>
<div class="post-update">

    <h1><?= Html::encode($model->title) ?></h1>
    <?php if (!Yii::$app->user->isGuest): ?>
        <a href="/post/update?id=<?=$model->id?>">[ Редактировать пост ]</a>
    <?php endif ?>
    <?=$model->content?>
    
</div>
