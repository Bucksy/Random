<?php

namespace app\models;

use yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Tag extends ActiveRecord {

    public function rules() {
        return [
            [['tag'], 'required', 'message' => 'Please choose a tag!'],
            ['tag', 'string', 'min' => 3, 'max' => 50],
            ['tag', 'unique']
        ];
    }

    //many-to-many relation
//    public function getPosts() {
//        return $this->hasMany(Post::className(), ['id' => 'post_id'])
//                        ->viaTable('posts_tags', ['tag_id' => 'id']);
//    }

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName() {
        return 'tags';
    }

}
