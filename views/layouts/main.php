<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#009900">
    <link rel="icon" sizes="800x800" href="/img/lizard.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?=$this->render('_header')?>
        <section role="main" class="content">
            <section class="leftColumn">
                <?= $content ?>
            </section>
            <section class="rightColumn">
                <article id="tagslist">
                    <h3>Категории:</h3>
                    <ul class="tags">
			<?php foreach (Yii::$app->tagLoader->tags as $tag): ?>
                        <li><?=Html::a($tag->name.' ('.$tag->rating.')','/tag/'.$tag->name)?></li>
			<?php endforeach ?>
                    </ul>
                </article>
                <article id="customColumn">
                    <?= \app\models\Page::findOne(3)->content ?>
                    <?php if (!Yii::$app->user->isGuest) echo Html::a('[ edit ]', ['/edit', 'pageId' => 3]) ?>
                </article>
            </section>
            <div class="clear"></div>
        </section>
    <?=$this->render('_footer')?>
<?php $this->endBody() ?>
<script>(function(d,e,s){if(d.getElementById("likebtn_wjs"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id="likebtn_wjs";a.src=s;m.parentNode.insertBefore(a, m)})(document,"script","//w.likebtn.com/js/w/widget.js");</script>
</body>
</html>
<?php $this->endPage() ?>