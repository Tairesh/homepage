<?php

use yii\helpers\Html;

?>
        <footer>
            <div class="text-right"><?= \app\models\Page::findOne(4)->content ?><?php if (!Yii::$app->user->isGuest) echo Html::a('[ edit ]', ['/edit', 'pageId' => 4]) ?></div>
            <p>&copy; Илья Агафонов, 2014&mdash;<?= date('Y') ?></p>
        </footer>
    </div>
