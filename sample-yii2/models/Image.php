<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use app\models\Post;

class Image extends ActiveRecord {

    //In the code above, we've created a model UploadForm with an atribute file that will become <input type="file"> in  the HTML form.
    //The atribute has the validation rule named file uses FileValidator.
//    public $image,
//           $caption;
   
     /**
    * @var mixed image the attribute for rendering the file input
    * widget for upload on the form
    */
    public $file;
    
    public static function tableName() {
        return 'images';
    }
    
    public function rules() {
        return [
            [['file'], 'file'],
            [['image'], 'string', 'max' => 100]
        ];
    }
    
    public function attributeLabels() {
        return [
            'file' => 'Images',
        ];
    }

    //TODO 
    //Relation 1-many , 1-1

    public function getPost() {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
