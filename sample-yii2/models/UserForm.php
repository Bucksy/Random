<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UserForm extends Model{
    
    public $name;
    public $email;
    
     /**
     * @return array the validation rules.
     */
    
    public function rules() {
        return [
           [['name', 'email'], 'required'],
            ['email', 'email'],
        ] ;
    }
    
    
}