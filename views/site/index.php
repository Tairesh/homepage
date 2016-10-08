<?php

/* @var $this yii\web\View */
/* @var $posts app\models\Post[] */

$this->title = Yii::$app->name;

?>
<?php if (!Yii::$app->user->isGuest): ?>
<p>
    <a href="/post/create">[ Новый пост ]</a>
</p>
<?php endif ?>

<?php foreach ($posts as $post): ?>
<article>
    <a href="/p/<?=urlencode($post->url)?>" class="date"><?=date('d.m.Y', $post->dateCreated)?></a>
    <?php if ($post->title): ?>
        <h2><a href="/p/<?=urlencode($post->url)?>"><?=$post->title?></a></h2>
    <?php endif ?>
    <?=$post->content?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <a href="/post/update?id=<?=$post->id?>">[ Редактировать пост ]</a>
    <?php endif ?>
</article>
<hr>
<?php endforeach ?>