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

    <header>
        <nav>
            <?=Html::a('Главная', ['/'])?> | <?=Html::a('Обо мне', ['/about'])?> | <?=Html::a('Контакты', ['/contact'])?>

            <div>
                <?=Html::a('Twitter', Yii::$app->params['twitterUrl'], ['target' => '_blank'])?>
                <?=Html::a('Facebook', Yii::$app->params['facebookUrl'], ['target' => '_blank'])?>
                <?=Html::a('VK', Yii::$app->params['vkUrl'], ['target' => '_blank'])?>
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
    <section role="main">
        <?= $content ?>
    </section>

    <footer>
        <p>&copy; Илья Агафонов, 2014&mdash;<?= date('Y') ?></p>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
