<?php

use yii\db\Migration;

class m161008_151633_pages_standart extends Migration
{
    public function up()
    {
        $this->insert('pages', [
            'title' => 'Обо мне',
            'label' => 'Обо мне',
            'content' => '<h2>Обо мне</h2><p>Привет, мир!</p>',
            'isActive' => 1,
            'inMenu' => 1
        ]);
        $this->insert('pages', [
            'title' => 'Контакты',
            'label' => 'Контакты',
            'content' => '<h2>Контакты</h2><p>Привет, мир!</p>',
            'isActive' => 1,
            'inMenu' => 1
        ]);
    }

    public function down()
    {
        $this->delete('pages');
    }

}
