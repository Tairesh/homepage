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
 * 
 * @property app\models\Tag[] $tags
 */
class Post extends \yii\db\ActiveRecord
{
    
    public $setTags = [];
    
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
            [['setTags'], 'safe'],
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
            'setTags' => 'Теги',
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
    
    public function afterSave($insert, $changedAttributes)
    {
        if (!$this->setTags) {
            $this->setTags = [];
        }
        $this->setTags = array_map('intval', $this->setTags);
        $savedTags = [];
        foreach ($this->tags as $tag) {
            if (in_array(intval($tag->id), $this->setTags)) {
                $savedTags[] = intval($tag->id);
            } else {
                $this->unlink('tags', $tag, true);
                $tag->calcRating();
            }
        }
        foreach ($this->setTags as $tagId) {
            if (!in_array($tagId, $savedTags)) {
                $tag = Tag::findOne($tagId);
                $this->link('tags', $tag);
                $tag->calcRating();
            }
        }
        
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tagId'])->viaTable('posts2tags', ['postId' => 'id']);
    }

    public static function findAllByTag(Tag $tag)
    {
	return self::find()
		->with('tags')
		->where(['tags.id' => $tag->id])
		->all();
    }
}

