<?php

/* @var $this yii\web\View */
/* @var $page app\models\Page */

use yii\widgets\ActiveForm;

$this->title = Yii::$app->name . ' | ' . $page->title;
$this->params['breadcrumbs'][] = $page->title;

?>
<?=$page->content?>
<?php if(!Yii::$app->user->isGuest): ?>
    <a href="/edit?pageId=<?=$page->id?>">[ Редактировать ]</a>    
<?php endif ?>
