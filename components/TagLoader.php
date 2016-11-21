<?php

namespace app\components;

use yii\base\Component;
use app\models\Tag;

class TagLoader extends Component {

    public function getTags()
    {
        return Tag::find()->where(['>', 'rating', 0])->orderBy(['rating' => SORT_DESC])->all();
    }

}
