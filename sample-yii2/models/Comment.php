<?php
namespace app\models;

use Yii;
use Yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Post;

class Comment extends ActiveRecord{
    
//    private $id;
//    public $author;
//    public $comment;
//    public $createdDate;
//    public $postId;
    
    public function rules() {
        return [
            ['author', 'required', 'message' => 'Please choose a author name'],
            ['comment', 'required', 'message' => 'Please choose a comment'],
            ['author' , 'string', 'min' => 3, 'max' => 50, 'message' => 'Too Short author name'],
            ['comment' , 'string', 'min' => 5, 'max' => 250, 'message' => 'Too Short or long comment'],
            ['post_id', 'required', 'message' => 'Please choose a post Id'],
        ];
    }

    public function attributeLabels() {
        return [
            'author' => 'Author name',
            'comment' => 'Your comment',
            'createdDate' => 'Created at:',
        ];
    }
    
    public function getPost(){
        return $this->hasOne(Post::className(), ['id' => 'post_id']); //1-1 komentar - post
    }
    
    public static function tableName() {
        return 'comments';
    }
}