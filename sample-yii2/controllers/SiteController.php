<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserForm;
use app\models\EntryForm;
use app\models\Country;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();//call a system variable 
        
        return $this->goHome(); //redirect to the different url 
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionHuen(){
        return $this->render('huen');
    }
    
    public function actionHello(){
        $name = 'hello';
        $array = array('first' =>1, 'second' => 2);
        return $this->render('hello', array('name' => $name, 'array' => $array));
        //return $name;
    }
    
    public function actionUser(){
        
        $model = new UserForm();
        //if the form is submitted and everything is validated.
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //let's right this later
            Yii::$app->session->setFlash('success','You have enter the data correctly');
            return $this->refresh();
        }else{
            return $this->render('UserForm', ['model' => $model]);
        }
    }
    
    public function actionSay($message = 'Hello'){
        return $this->render('say', ['message' => $message]);
    }
    
    public function actionEntry(){
        
        //creates object EntryForm
        $model = new EntryForm();
       
        //if the user has submitted the Html form, and the action will call the validate() to make sure the data are valid.
        if ($model->load(Yii::$app->request->post()) && $model->validate()) { //if everything is fine, the action will call the render function 
            return $this->render('entry-confirm', ['model' => $model]);
        }else{
            return $this->render('entry', ['model' => $model]);
        }
    }
    
    public function actionAtt(){
        
        //ATTRIBUTES: 
      $model = new \app\models\ContactForm;//object of type ContactForm.
        // "name" is an attribute of ContactForm
      $model->name = 'Example';
       // echo $model->name;
      $model->setAttributes('ok');
      $model->name = 'Ники';
      echo $model->getAttributeLabel('name');
      $model->name = 'Alexander';
      
    //  $model = new \app\models\User;
      //$model->scenario = 'login';
      
      //ili chrez configuration 
    
      
       
     
      //iterate attributes:
//       foreach ($model as $k=>$v) {
//                echo $k. ' '. $v;
//       }
     
     //DEFINING ATTRIBUTES: 
     //By default, if your model class extends directly from yii\Base\Model
     // all its non static public member variable are attributes
     //ContactForm model e napraven za da predstavqt dannite, idvashti ot HTML formata 
      //The attributes() - vrushta imenata na attributtite v model.
      
      //yii\bd\ActiveRecord - pak vrushta imenata na kolonite v database.
     
      // populate model attributes with user inputs
      $model->attributes = \Yii::$app->request->post('ContactForm');
   
      if($model->validate()){ // return true
          //all inputs are valid
          echo 'ok';
      }else{ //keep the errors in the $errors property and return false;
          //validation failed : errors
          $errors = $model->errors;
      }
    }
    

    public function actionSession(){
        
        $session = Yii::$app->session;
        
        //echo '<pre>' . print_r($session, true) . '</pre>';
        //$session->destroy();
        //$session->close();
       // echo '<pre>' . print_r($_SESSION['password'], true) . '</pre>';
        
        $test = $session->set('username', 'Huen');
        $test1 = $session->get('username');
        
        $test2 = $session->set('password', 'Joro');
        $test2 = $session->get('password');
        
        echo '<pre>' . print_r($test1, true) . '</pre>';
        echo '<pre>' . print_r($test2, true) . '</pre>';
      
        foreach ($session as $name => $value) {
            echo '<pre>' . print_r($name, true) . '</pre>';
           //echo '<pre>' . print_r($value, true) . '</pre>';
        }
        
        
        $session->setFlash('postDeleted', 'You have successfully deleted');
        echo $session->getFlash('postDeleted');
        if ($session->hasFlash('postDeleted')) {
            //$result will be false since the flash message was automatically deleted
            echo 'ok';
        }
        
        $session->addFlash('alerts', 'You have successfully deleted your post1!');
        $session->addFlash('alerts', 'You have successfully deleted your post2!');
        $session->addFlash('alerts', 'You have successfully deleted your post3!');
        
        echo '<pre>' . print_r($session->getFlash('alerts'), true) . '</pre>';
        
        $cookies = Yii::$app->request->cookies;
        echo  $cookies->getValue('language', 'eng');
        if (($cookie = $cookies->get('language')) != null) {
           $language = $cookie->value;
          // echo $language;
         }
       
         if (isset($cookies['language'])) {
           $language = $cookies['language']->value;
         }
       
//        if (isset($session['__id'])) {
//            //echo '<pre>' . print_r($session['__id'], true) . '</pre>';
//           //echo '<pre>' . print_r($session['id'], true) . '</pre>';
//            echo 'We Have Session';
//        }else{
//            echo 'No session';
//        }
    }
    
    public function actionUpload() {
        $model = new \app\models\UploadForm();
        $request = Yii::$app->request;
        if ($request->isPost) {
            $model->file = \yii\web\UploadedFile::getInstances($model, 'file');

            if ($model->file && $model->validate()) {
                foreach ($model->file as $file) {
                    $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                }
            }
        }
        return $this->render('upload', ['model' => $model]);
    }
    
    public function actionData(){
        echo Yii::$app->formatter->asDate('2015-01-01', 'long');
        echo Yii::$app->formatter->asDate('2015-01-01', 'int');
    }
}
