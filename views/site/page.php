<?php

/* @var $this yii\web\View */
/* @var $page app\models\Page */

use yii\widgets\ActiveForm;

$this->title = $page->title . ' | ' . Yii::$app->name;
$this->params['breadcrumbs'][] = $page->title;

?>
<?=$page->content?>
<?php if(!Yii::$app->user->isGuest): ?>
    <a href="/edit?pageId=<?=$page->id?>">[ Редактировать ]</a>    
<?php endif ?>
