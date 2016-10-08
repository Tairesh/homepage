<?php

/* @var $this yii\web\View */
/* @var $page app\models\Page */

use yii\widgets\ActiveForm,
    yii\helpers\Html;

$this->title = Yii::$app->name . ' | ' . $page->title;
$this->params['breadcrumbs'][] = $page->title;

?>
<?php $form = ActiveForm::begin([
    'id' => 'edit-form',
]); ?>

<?= $form->field($page, 'title')->textInput(['autofocus' => true]) ?>

<?= $form->field($page, 'label')->textInput() ?>

<?= $form->field($page, 'content')->textArea() ?>

<?= $form->field($page, 'isActive')->checkbox() ?>

<?= $form->field($page, 'inMenu')->checkbox() ?>

<?= Html::submitButton('Сохранить') ?>

<?php ActiveForm::end(); ?>