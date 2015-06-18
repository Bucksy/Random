<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Image;
use yii\base\Exception;

class ImageController extends Controller {
    
    public function actionDelete($id) {
            
        $img = Image::findOne($id);
       
        if ($img === NULL) {
            //Redirect to other page not found (404)
            throw new Exception("The image does not exist!");
        } else {
            //Delete the path in database 
            $img->delete();
            $file = $img->image;
            unlink($file);
            return $this->redirect('?r=post/update&id=' . $img->post_id);
        }
    }
}
