<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
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
            <?= $content ?>
            <div class="clear"></div>
        </section>
    <?=$this->render('_footer')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
