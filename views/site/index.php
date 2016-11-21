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
    <?php if (count($post->tags)): ?>
    <ul class="tags">
        <?php foreach ($post->tags as $tag): ?>
        <li>
            <a href="/tag/<?=urlencode($tag->name)?>"><?=$tag->name?></a>
        </li>
        <?php endforeach ?>
    </ul>
    <?php endif ?>
    <div class="post-content">
        <?php if ($post->title): ?>
        <h2>
            <?=Html::a($post->title, Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]))?>
        </h2>
        <?php endif ?>
        <ul class="post-meta">
            <li>
                <?=Html::a(date('d.m.Y', $post->dateCreated), Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]))?>
            </li>
            <li>
                <span class="likebtn-wrapper" data-theme="transparent" data-lang="ru" data-rich_snippet="true" data-identifier="post_like_<?=$post->id?>" data-dislike_enabled="false" data-icon_dislike_show="false" data-counter_clickable="true" data-item_url="https://agafonov.xyz<?=urldecode(Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]))?>" data-item_title="<?=$post->title?>" data-lazy_load="true" data-loader_show="true"></span>
            </li>
            <?php if (!Yii::$app->user->isGuest): ?>
            <li>
                <a href="/post/update?id=<?=$post->id?>">[ EDIT ]</a>
            </li>
            <?php endif ?>
        </ul>
        <div class="post-body">
            <?=$post->content?>
        </div>
        <div class="clear"></div>
    </div>
</article>
    <?php break; 
    case Post::TYPE_QUOTE: ?>
<article>
    <?php if (count($post->tags)): ?>
    <ul class="tags">
        <?php foreach ($post->tags as $tag): ?>
        <li>
            <a href="/tag/<?=urlencode($tag->name)?>"><?=$tag->name?></a>
        </li>
        <?php endforeach ?>
    </ul>
    <?php endif ?>
    <div class="post-content">
        <q>
            <p><?=$post->content?></p>
        </q>
        <ul class="post-meta">
            <li>
                <?=Html::a(date('d.m.Y', $post->dateCreated), Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]))?>
            </li>
            <li>
                <span class="likebtn-wrapper" data-theme="transparent" data-lang="ru" data-rich_snippet="true" data-identifier="post_like_<?=$post->id?>" data-dislike_enabled="false" data-icon_dislike_show="false" data-counter_clickable="true" data-item_url="https://agafonov.xyz<?=urldecode(Yii::$app->urlManager->createUrl(['post/view', 'id' => $post->id]))?>" data-item_title="<?=$post->title?>" data-lazy_load="true" data-loader_show="true"></span>
            </li>
            <?php if (!Yii::$app->user->isGuest): ?>
            <li>
                <a href="/post/update?id=<?=$post->id?>">[ EDIT ]</a>
            </li>
            <?php endif ?>
        </ul>
        <div class="post-body">
            <?=$post->title?>
        </div>
        <div class="clear"></div>
    </div>
</article>
    <?php break;
 endswitch ?>
<?php endforeach ?>
<?=LinkPager::widget(['pagination' => $pagination])?>
<?php Pjax::end() ?>