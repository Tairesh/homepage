<?php

/* @var $this \yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

?>
    <div class="wrapper">
        <header>
            <nav>
                <?=Html::a('Главная', ['/'])?> | <?=Html::a('Обо мне', ['/about'])?> | <?=Html::a('Контакты', ['/contact'])?>

                <div>
                    <?=Html::a('<i class="icon twitter"></i>', Yii::$app->params['twitterUrl'], ['target' => '_blank', 'title' => 'Twitter'])?>
                    <?=Html::a('<i class="icon facebook"></i>', Yii::$app->params['facebookUrl'], ['target' => '_blank', 'title' => 'Facebook'])?>
                    <?=Html::a('<i class="icon vk"></i>', Yii::$app->params['vkUrl'], ['target' => '_blank', 'title' => 'VK'])?>
                    <?=Html::a('<i class="icon telegram"></i>', Yii::$app->params['telegramUrl'], ['target' => '_blank', 'title' => 'Telegram'])?>
                </div>
            </nav>

            <h1>Илья Агафонов<!--<span>gray text</span>--></h1>
            <!--<span>База знаний</span>-->
        </header>
        <section id="breadcrumbs">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </section>