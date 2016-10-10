<?php

use app\models\Post;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $posts app\models\Post[] */
/* @var $pagination yii\data\Pagination */

$this->title = Yii::$app->name;

?>
<?php if (!Yii::$app->user->isGuest): ?>
<p>
    <a href="/post/create">[ Новый пост ]</a>
</p>
<?php endif ?>
<?php Pjax::begin() ?>
<?php foreach ($posts as $i => $post): ?>
<?php switch ($post->type): 
    case Post::TYPE_TEXT: ?>
<article>
    <?php if ($post->title): ?>
        <h2><a href="/p/<?=urlencode($post->url)?>"><?=$post->title?></a></h2>
    <?php endif ?>
    <?=Html::a(date('d.m.Y', $post->dateCreated), Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]), ['class' => 'date'])?>
    <?=$post->content?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <a href="/post/update?id=<?=$post->id?>">[ Редактировать пост ]</a>
    <?php endif ?>
</article>
    <?php break; 
    case Post::TYPE_QUOTE: ?>
<article>
    <blockquote>
        <p><?=$post->content?></p>
        <p class="author" >— <?=$post->title?></p>
    </blockquote>
    <?php if (!Yii::$app->user->isGuest): ?>
        <a href="/post/update?id=<?=$post->id?>">[ Редактировать пост ]</a>
    <?php endif ?>
</article>
    <?php break;
 endswitch ?>
<?php if ($i < count($posts)-1): ?><hr><?php endif ?>
<?php endforeach ?>
<?=LinkPager::widget(['pagination' => $pagination])?>
<?php Pjax::end() ?>