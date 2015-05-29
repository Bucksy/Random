<?php

namespace app\models;

use Yii;
use Yii\base\Model;


class CommentForm extends Model {
    
    //attributes
    public $author;
    public $comment;
    public $createdDate;
    public $postId;
    
    /**
     *@return an array of validation  rules
     */
    
    public function rules(){
        
        return [
            //author , comment, created, - are required
            
            ['author', 'required', 'message'=> 'Please choose a author name.'],
            ['comment', 'required' , 'message'=> 'Comments are required.'],
            ['author', function($attribute, $params){
                    if (strlen($this->attribute) < 5) {
                        $this->addError($attribute, 'The author must contain at least 3 characters');
                    }
            }],
            ['comment', function($attribute, $params){
                    if (strlen($this->attribute) > 250 && strlen($this->attribute) < 0) {
                        $this->addError($attribute, 'The comment must contain at least 3 characters');
                    }
            }],
            [['createdDate'], 'date', 'format' => 'yyyy-M-d H:m:s'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'title' =>'Your title',
            'description' => 'Your Description',
            'created' => 'Created Date'
        ];
    }
}