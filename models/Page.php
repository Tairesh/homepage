<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $label
 * @property string $content
 * @property boolean $isActive
 * @property boolean $inMenu
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'label', 'content'], 'required'],
            [['content'], 'string'],
            [['isActive', 'inMenu'], 'boolean'],
            [['title', 'label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'label' => 'Метка',
            'content' => 'Содержимое',
            'isActive' => 'Активна',
            'inMenu' => 'Показывать в меню',
        ];
    }
}
