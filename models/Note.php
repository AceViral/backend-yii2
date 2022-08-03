<?php

namespace app\models;

use yii\db\ActiveRecord;

class Note extends ActiveRecord
{ 
    public static function tableName()
    {
        return 'note';
    }

    public function rules()
    {
        return [
            [['title', 'body'], 'string', 'max' => 255],
        ];
    }
}