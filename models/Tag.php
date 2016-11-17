<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property integer $id
 * @property string $name
 * @property integer $rating
 *
 * @property Posts[] $posts
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['rating'], 'integer', 'min' => 0],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'rating' => 'Рейтинг',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'postId'])->viaTable('posts2tags', ['tagId' => 'id']);
    }
    
    public function calcRating($save = true)
    {
        $this->rating = $this->getPosts()->count();
        if ($save) {
            $this->save();
        }
    }

    public static function findByName($name)
    {
	return self::find()->where(['name' => $name])->one();
    }
}
