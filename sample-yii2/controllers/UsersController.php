<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Users;

class UsersController extends Controller{
    
    public function actionIndex(){
      $users = Users::find()->all(); // find all the records in out table users 
      // echo '<pre>' . print_r($users, true) . '</pre>';
      return $this->render('index', ['users'=>$users]);
    }
}
