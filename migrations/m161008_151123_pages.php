<?php

use yii\db\Migration;

class m161008_151123_pages extends Migration
{
    public function up()
    {
        $this->createTable('pages', [
            'id' => 'INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL',
            'title' => 'VARCHAR(255) NOT NULL',
            'label' => 'VARCHAR(255) NOT NULL',
            'content' => 'TEXT NOT NULL',
            'isActive' => 'BOOLEAN NOT NULL DEFAULT 0',
            'inMenu' => 'BOOLEAN NOT NULL DEFAULT 0'
        ]);
    }

    public function down()
    {
        $this->dropTable('pages');
    }
}
