<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\Tag;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */

$model->setTags = ArrayHelper::getColumn($model->tags,'id');

?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->dropDownList([1 => 'Текст', 2 => 'Цитата']) ?>

    <?= $form->field($model, 'isActive')->checkbox() ?>

    <?= $form->field($model, 'onMain')->checkbox() ?>

    <?= $form->field($model, 'setTags')->widget(Select2::classname(), [
            'language' => 'ru-RU',
            'data' => ArrayHelper::map(Tag::find()->all(),'id','name'),
            'options' => ['multiple' => 'multiple'],
            'pluginOptions' => [
                'allowClear' => true,
                'buttonContainer'=>'<div class="form-group" style="position:relative;" />',
                'checkboxName' => 'Post[setTags]'
            ],
        ]);
    ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить') ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
