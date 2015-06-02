<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Posts
 *
 * @author nhuen
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord; // Active Record extends from yii\base\Model, it inherits all model features, such as attributes, validation rules. etc, , thats why it extends yii\Base\Model
use app\models\Comment;

class Post extends ActiveRecord{

       //    public $id;
       //    public $title;
      //   public $description;
     //    public $created;
     //    public $userId;

    //validation rules 
   public function rules() {
        return [
            //title , description - are required
           [['title', 'description'], 'required', 'message' => 'Please choose a title or description'],
            ['title' , 'string', 'min' => 3, 'max' => 20, 'message' => 'Too Short Title'],
//            ['title', 'validateTitle'],
            ['description', 'string', 'min'=> 3, 'max' => 200, 'message' => 'Too Short or long description']
        ];
    }
 
    public function validateTitle(){
        if (strlen($this->title) <= 3 && strlen($this->title) >= 20) {
            $this->addError('title', 'Incorrect username or password');
        }
    }
    
    public function attributeLabels() {
        return [
            'title' =>'Title',
            'description' => 'Description',
        ];
    }
    
    public function getComments(){
        return $this->hasMany(Comment::className(), ['post_id' => 'id']); //1 -> many , 1 - post -> many comments, post_id e na Comment klasa, id - Post klasa
    }
    

    //many-to-many relation
    public function getTags(){
        return $this->hasMany(Tag::className(), ['id' => 'tag_id']) 
                ->viaTable('posts_tags', ['post_id' => 'id']);
    }
    
      /**
       *@return string the name of the table associated with this ActiveRecord class.
       *
       */
    
    public static function tableName() {
        return 'posts';
    }
}