<?php

use yii\db\Migration;

class m161012_074721_tags extends Migration
{
    
    public function up()
    {
        $this->createTable('tags', [
            'id' => 'INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL',
            'name' => 'VARCHAR(255) NOT NULL',
            'rating' => 'UNSIGNED INTEGER NOT NULL DEFAULT 0',
        ]);
        $this->createIndex('tagsName', 'tags', ['name'], true);
        $this->createIndex('tagsRating', 'tags', ['rating']);
        
        $this->createTable('posts2tags', [
            'postId' => 'INTEGER REFERENCES posts(id) NOT NULL',
            'tagId' => 'INTEGER REFERENCES tags(id) NOT NULL',
        ]);
        $this->createIndex('post2tag', 'posts2tags', ['postId', 'tagId'], true);
    }

    public function down()
    {
        $this->dropTable('tags');
        $this->dropTable('posts2tags');
    }
}
