<?php

namespace app\controllers;

use yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Tag;

class TagController extends Controller {

    public function actionCreate() {

        $request = Yii::$app->request;

        $model = new Tag();
        
        if ($request->isPost) {

            $tagResult = $request->post()['Tag'];
            $model->tag = $tagResult['tag'];
            
//            exit(var_dump($tagResult));
            if ($model->validate()) {
                $model->save();
                return $this->redirect('?r=tag/index', 302);
            } else {
                return $this->render('create', ['model' => $model]);
            }
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionView($id = null) {
        
       $request = Yii::$app->request;
       
       $tag = Tag::find()
               ->where(['id' => $id])
               ->one();
       
       if (empty($tag)) {
           throw new \Exception("The tag does not exist!");
       }
       
       if ($request->isGet) {
            return $this->render('view', ['model'=> $tag]);
       }else{
           return $this->render('create');
       }
    }

    public function actionUpdate($id) {

        $request = Yii::$app->request;
        $tag = Tag::findOne($id);
        // exit(var_dump($tag));

        if ($request->isGet) {
            return $this->render('update', ['model' => $tag]); //form
        } else if ($request->isPost) {

            $t = $request->post()['Tag'];
            //exit(var_dump($t));
            $tag->tag = $t['tag'];
            // exit(var_dump($tag->tag)); 
            if ($tag->validate()) {
                $tag->save();
                return $this->redirect('?r=tag/index', 302);
            }else {
                return $this->render('update', ['model' => $tag]);
            }
        }
    }

    public function actionDelete($id){
        
        $tag = Tag::findOne($id);
      
        if (empty($tag)) {
            throw new \Exception('The Tag is empty!');
        }else{
         $tagDeleted = $tag->delete();
        return $this->redirect('?r=tag/index', 302);
        }
    }
    
    public function actionIndex() {
        
        //return $this->render('index');
        //query za fetchvane na vs records 
        $tags = Tag::find()->all();
        //exit(var_dump($tags));
        return $this->render('index', ['tags'=>$tags]);
    }
    
}
