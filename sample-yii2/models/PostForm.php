<?php

namespace app\models;

use yii;
use yii\base\Model;

class PostForm extends Model {
    
    //attributes
    public $title;
    public $description;
    public $created;
    public $userId;
    
    /**
     *@return an array of validation  rules
     */
    public function rules(){
        
        return [
            //title , description, created, - are required
            
            ['title', 'required', 'message'=> 'Please choose a title.'],
            ['description', 'required' , 'message'=> 'Please choose a description.'],
            ['title', function($attribute, $params){
                    if (strlen($this->attribute) < 3) {
                        $this->addError($attribute, 'The title must contain at least 3 characters');
                    }
            }],
            ['description', function($attribute, $params){
                    if (strlen($this->attribute) > 50 && strlen($this->attribute) < 0) {
                        $this->addError($attribute, 'The description must contain at least 3 characters');
                    }
            }],
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
