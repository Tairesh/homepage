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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">
        <header>
            <nav>
                <?=Html::a('Главная', ['/'])?> | <?=Html::a('Обо мне', ['/about'])?> | <?=Html::a('Контакты', ['/contact'])?>

                <div>
                    <?=Html::a(Html::img('/img/407-twitter.png'), Yii::$app->params['twitterUrl'], ['target' => '_blank', 'title' => 'Twitter'])?>
                    <?=Html::a(Html::img('/img/402-facebook2.png'), Yii::$app->params['facebookUrl'], ['target' => '_blank', 'title' => 'Facebook'])?>
                    <?=Html::a(Html::img('/img/409-vk.png'), Yii::$app->params['vkUrl'], ['target' => '_blank', 'title' => 'VK'])?>
                    <?=Html::a(Html::img('/img/406-telegram.png'), Yii::$app->params['telegramUrl'], ['target' => '_blank', 'title' => 'Telegram'])?>
                </div>
            </nav>

            <h1>Илья Агафонов<!--<span>gray text</span>--></h1>
            <span>Об уральском регионализме и жизни</span>
        </header>
        <section id="breadcrumbs">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </section>
        <section role="main" class="content">
            <section class="leftColumn">
                <?= $content ?>
            </section>
            <section class="rightColumn">
                asda
            </section>
        </section>
        <footer>
            <p>&copy; Илья Агафонов, 2014&mdash;<?= date('Y') ?></p>
        </footer>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
