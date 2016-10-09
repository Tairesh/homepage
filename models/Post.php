<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $content
 * @property integer $type
 * @property integer $dateCreated
 * @property integer $dateEdited
 * @property boolean $isActive
 * @property boolean $onMain
 */
class Post extends \yii\db\ActiveRecord
{
    
    /**
     * Текстовый пост
     */
    const TYPE_TEXT = 1;
    
    /**
     * Цитата
     */
    const TYPE_QUOTE = 2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['type', 'dateCreated', 'dateEdited'], 'integer'],
            [['isActive', 'onMain'], 'boolean'],
            [['title', 'url'], 'string', 'max' => 255],
            [['url'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок/автор',
            'url' => 'Url',
            'content' => 'Контент',
            'type' => 'Тип',
            'isActive' => 'Активно',
            'onMain' => 'Показывать на главной',
        ];
    }
    
    public function generateUrl()
    {
        $this->url = $this->title ? str_replace(' ', '_', $this->title) : str_replace(' ', '_', strtr($this->content, 0, 140));
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->dateCreated = time();
        } else {
            $this->dateEdited = time();
        }
        if (!$this->url) {
            $this->generateUrl();
        }
        return parent::beforeSave($insert);
    }
}
