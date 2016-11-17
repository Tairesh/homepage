<?php

use yii\db\Migration;

class m161117_082741_add_fake_pages extends Migration
{
    public function safeUp()
    {
        $this->insert('pages', [
            'id' => 3,
            'title' => 'Правая колонка',
            'label' => 'Правая колонка',
            'content' => '<p>Привет, мир!</p>',
            'isActive' => 1,
            'inMenu' => 0
        ]);
        $this->insert('pages', [
            'id' => 4,
            'title' => 'Футер справа',
            'label' => 'Футер срава',
            'content' => '<p>Привет, мир!</p>',
            'isActive' => 1,
            'inMenu' => 0
        ]);
    }

    public function safeDown()
    {
        $this->delete('pages', ['in', 'id', [3,4]]);
    }
}
