<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title . ' | ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => $model->title ? $model->title : "post #{$model->id}"];

?>
<article class="post-view">
    <?php if (count($model->tags)): ?>
    <ul class="tags">
        <?php foreach ($model->tags as $tag): ?>
        <li>
            <a href="/tag/<?=urlencode($tag->name)?>"><?=$tag->name?></a>
        </li>
        <?php endforeach ?>
    </ul>
    <?php endif ?>
    <h1><?= Html::encode($model->title) ?></h1>
    <?=$model->content?>
    
    <?php if (!Yii::$app->user->isGuest): ?>
        <a href="/post/update?id=<?=$model->id?>">[ Редактировать пост ]</a>
    <?php endif ?>
</article>
