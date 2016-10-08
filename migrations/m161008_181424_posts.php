<?php

use yii\db\Migration;

class m161008_181424_posts extends Migration
{
    public function up()
    {
        $this->createTable('posts', [
            'id' => 'INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL',
            'title' => 'VARCHAR(255) DEFAULT NULL',
            'url' => 'VARCHAR(255) NOT NULL',
            'content' => 'TEXT NOT NULL',
            'type' => 'INTEGER(1) NOT NULL DEFAULT 1',
            'dateCreated' => 'INTEGER NOT NULL',
            'dateEdited' => 'INTEGER DEFAULT NULL',
            'isActive' => 'BOOLEAN NOT NULL DEFAULT 0',
            'onMain' => 'BOOLEAN NOT NULL DEFAULT 0',
        ]);
        $this->createIndex('postUrl', 'posts', ['url'], true);
    }

    public function down()
    {
        $this->dropTable('posts');
    }
}
