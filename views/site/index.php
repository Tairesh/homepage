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
    <ul class="tags">
        <li>
            <a href="#">Тестовый тег</a>
            <a href="#">Ещё тег</a>
        </li>
    </ul>
    <div class="post-content">
        <?php if ($post->title): ?>
        <h2>
            <?=Html::a($post->title, Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]))?>
        </h2>
        <?php endif ?>
        <div class="post-body">
            <?=$post->content?>
        </div>
        <ul class="post-meta">
            <li>
                <?=Html::a(date('d.m.Y', $post->dateCreated), Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]))?>
            </li>
            <li>
                Поделиться
            </li>
            <?php if (!Yii::$app->user->isGuest): ?>
            <li>
                <a href="/post/update?id=<?=$post->id?>">[ EDIT ]</a>
            </li>
            <?php endif ?>
        </ul>
        <div class="clear"></div>
    </div>
</article>
    <?php break; 
    case Post::TYPE_QUOTE: ?>
<article>
    <ul class="tags">
        <li>
            <a href="#">Тестовый тег</a>
            <a href="#">Ещё тег</a>
        </li>
    </ul>
    <div class="post-content">
        <q>
            <p><?=$post->content?></p>
        </q>
        <div class="post-body">
            <?=$post->title?>
        </div>
        <ul class="post-meta">
            <li>
                <?=Html::a(date('d.m.Y', $post->dateCreated), Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]))?>
            </li>
            <li>
                Поделиться
            </li>
            <?php if (!Yii::$app->user->isGuest): ?>
            <li>
                <a href="/post/update?id=<?=$post->id?>">[ EDIT ]</a>
            </li>
            <?php endif ?>
        </ul>
        <div class="clear"></div>
    </div>
</article>
    <?php break;
 endswitch ?>
<?php endforeach ?>
<?=LinkPager::widget(['pagination' => $pagination])?>
<?php Pjax::end() ?>