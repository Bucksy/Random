<?php

namespace app\models;

use yii;
use yii\base\Model;

class EntryForm extends Model {
   
    //The EntryForm class contains two public members - name, email 
    public $name;
    public $email;
    
    //return a set of rules for validating the data .
    public function rules(){
        
        return [
            [['name','email'], 'required'],
            ['email', 'email']
        ];
    }
}
