<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostsController
 *
 * @author nhuen
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Post;
use yii\data\Pagination;
use yii\data\Sort;
use app\models\Comment;
use app\models\Tag;
use yii\web\UploadedFile;
use app\models\Image;

class PostController extends Controller {

    public function actionView($id, $version = null) {

        $request = Yii::$app->request;
        $post = Post::find()
                ->where(['id' => $id])
                ->one();

        //$post = Post::find($id);
        //if we dont have a post like above one .

        if ($post == NULL) {
            throw new \Exception("The post does not exist!");
        } else {

            $comments = $post->getComments()->all();
            $tags = $post->getTags()->all();
            $comment = new Comment();

            if ($request->isPost) {
                $commentResult = $request->post()['Comment'];

                $comment->author = $commentResult['author'];
                $comment->comment = $commentResult['comment'];
                $comment->post_id = $post->id;

                if ($comment->validate()) {
                    $comment->save();
                    return $this->refresh();
                } else {
                  //errors? 
//                  $errors = $comment->getErrors();
                }
            }
            return $this->render('view', ['post' => $post, 'version' => $version, 'comments' => $comments, 'comment' => $comment, 'tags' => $tags]);
        }
    }
    
    /**
     * Creates a new Post Model(), Tag Model and Image Model.
     * If creation is successfull, the browser will  redirected to the index page
     * @return mixed
     */
    
    public function actionCreate() {

        $request = Yii::$app->request;
        $post = new Post();
        $tag = new Tag();
        $uploadFile = new Image();

        $tags = Tag::find()->asArray(true)->all(); // fetch as an array of arrays 
        
//        if ($post->load($request->post())) {//if we have post request
//            exit(var_dump($_POST));
           if($post->load($request->post())){
//          exit(var_dump($_POST));
            $postResult = $request->post()['Post'];
            $tagResult = $request->post()['Tag'];
            $imageResult = $request->post()['Image'];

            if ($post->validate()) {
                
                $post->userId = 2; //TODO - Session_id = user_id
                $post->save();
                //TODO - take the last record //zashtoto samo kogato imash post -> id v bazata togava shte imash id - > da go slagash v tablicata Image
              
                 $id = Yii::$app->db->getLastInsertID();
//               exit(var_dump($id));
                 foreach ($tagResult['tag'] as $tagId) {
                    $tagRelation = Tag::findOne($tagId);
                    $post->link('tags', $tagRelation);
                 }
                 
                //Upload multiple files
                //get the instance of the uploaded file v bazata
                 $uploadFile->file = UploadedFile::getInstances($uploadFile, 'file');
                 
                //exit(var_dump($uploadFile->file->baseName));
                if ($uploadFile->file && $uploadFile->validate()) {
                    foreach ($uploadFile->file as $file) {
//                      exit(var_dump($file->image));
                        $this->saveFile($file, $imageResult['caption'], $id);
                    }
                }
                
                //Upload one file 
                //and save the file in "uploads" folder
                //$uploadFile->file->saveAs('uploads/' . $uploadFile->file->baseName . '.' . $uploadFile->file->extension);
                //save the path in the column in database 
                //$uploadFile->image = 'uploads/' . $uploadFile->file->baseName . '.' . $uploadFile->file->extension;
                //$uploadFile->caption = $imageResult['caption'];

                //$uploadFile->post_id = $id; //TODO - Relation still does not work

                //$uploadFile->save();
                
                return $this->redirect('?r=post/index', 302);
            } else {
                return $this->render('create', ['model' => $post]);
            }
        } else { //get request - when we click on the url 
               return $this->render('create', ['model' => $post, 'tags' => $tags, 'tag' => $tag,  'uploadFile' => $uploadFile]);
        }
    }

    
    public function saveFile($file, $caption, $id) {
       
        $uploadFile = new Image();
        $time = time();
        $randomNumber = rand(1, 200);
        
        $file->saveAs('uploads/' . $file->baseName . '_' . $time . '_' . $randomNumber . '.' . $file->extension);
        $uploadFile->image = 'uploads/' . $file->baseName . '_' . $time . '_' . $randomNumber . '.' . $file->extension;
        
        $uploadFile->caption = $caption;
        $uploadFile->post_id = $id;
        $uploadFile->save();
    }
     
    /**
     * Update existing post
     * If the update is successfull, the browser will redirect to the  index page.
     * @param type $id
     * @return type
     */
    
    public function actionUpdate($id) {

        $request = Yii::$app->request;
        $post = Post::findOne($id);
        $uploadFile = new Image();
        $tag = new Tag();
    
        //$tags = Tag::find()->asArray(true)->all();
        //$tagsList = $post->getTags()->asArray(true)->all();
        if ($post == NULL) {
            throw new \Exception("The post or tags does not exist!");
        } else {

            $tags = Tag::find()->asArray(true)->all();
            $tagsList = $post->getTags()->asArray(true)->all();
            
            //Gallery here!
            $images = $post->getImages()->asArray(true)->all();
            
           //exit(var_dump($images));
            
            if ($request->isGet) {
                return $this->render('update', ['model' => $post, 'tags' => $tags, 'tag' => $tag, 'tagsList' => $tagsList, 'images' => $images, 'uploadFile' => $uploadFile]);
            } else if ($request->isPost) {
                if ($post->validate()) { //TODO with tags - from database 
//                  exit(var_dump($_POST));
                    $title = $request->post()['Post']['title']; //title from Post
                    $description = $request->post()['Post']['description']; //description from Post
                    $imageResult = $request->post()['Image'];  
                            
                    $tags = $request->post()['Tag']['id']; //post request
                    $post->title = $title;
                    $post->description = $description;

                    $post->save();
                    
                    $uploadFile->file = UploadedFile::getInstances($uploadFile, 'file');
//                    exit(var_dump($uploadFile->file));
                   
                    if ($uploadFile->file && $uploadFile->validate()) {
                        foreach ($uploadFile->file as $file) {
//                          exit(var_dump($file));
                            $this->saveFile($file, $imageResult['caption'], $id);
                        }
                    }
                    
                    $oldTags = $post->getTags()->asArray(true)->all();
                   
                    //remove old tags
                    if (is_array($tags) && !empty($oldTags)) {
                        foreach ($oldTags as $oldTag) {
                            //exit(var_dump($oldTag));
                            //poneje oldTag e masiv - > nie za da vruzvame dva model, masiva oldTag - > trqbva da e obekt -> zatova go pravim object
                            $tagRelation = Tag::findOne($oldTag);  //object tagReletion
                            $post->unlink('tags', $tagRelation, true); //tagRelation - model(object) -> link (post)
                        }
                    }
                  
                    //add new tags
                    if (is_array($tags)) {
                        foreach ($tags as $tagId) {
                            $tagRelation = Tag::findOne($tagId);
                            $post->link('tags', $tagRelation);
                        }
                    }
                    return $this->redirect('?r=post/index', 302);
                }
            }
        }
    }

    public function actionDelete($id) {

        //Iztrivame post-a , t.e v Post + vruzkata m/u posta i tags -> t/e  
        $post = Post::findOne($id);
        $images = $post->getImages()->asArray(true)->all();
        
        if ($post == NULL) {
            throw new \Exception('The post is  empty');
        } else {
            $oldTags = $post->getTags()->asArray(true)->all();
            $post->delete(); //ne e svurzan s drugite modeli, zatova nego shte iztriem

            foreach ($oldTags as $oldTag) {
                $oldTagRelation = Tag::findOne($oldTag);
                $post->unlink('tags', $oldTagRelation, true);
            }
            
            if (is_array($images)) {
                foreach ($images as $image) {
                    $imageRelation = Image::findOne($image); //to use the function delete() the image should be a object - >so we have to make it object 
                    $imageRelation->delete();
                    $file = $imageRelation->image;
                    unlink($file);
                }
            }
            
            return $this->redirect('?r=post/index', 302);
        }
    }

    public function actionUpload() {

        $model = new UploadForm();

        $request = Yii::$app->request;
        if ($request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
//                return $this->render('index');
            }
        }
        return $this->render('upload', ['model' => $model]);
    }

    public function actionIndex() {

        $request = Yii::$app->request;
        $get = $request->get();
        
//        exit(var_dump($get));
        // echo '<pre>' . print_r($get, true) . '</pre>';
        // exit;  
        // $request = Yii::$app->request;
        //  $params = $request->bodyParams;
        //var_dump($params);
        //Insert a row into database 
        //  $p = new Post();
        //      $p->title = 'Huen11111';
        //      $p->description = 'Huen11';
        //      $p->created = '2015-07-05 12:00:00';
        //      $p->save();
        //Update an existing row of data
//        $p = Post::findOne(282);
//        $p->description = 'Big Bang';
//        $p->save(); //when you call save, by default it will call validate() automatically 
//Massive Assignment
//        $values  = [
//            'title' => 'New One',
//            'description' => 'Test',
//            'created' => '2015-03-06 17:33:07',
//            'userId' => 3
//        ];
//        
//        $p1 = new Post();
//        $p1->attributes = $values;
//        $p1->save();
//        1) Pravish array s hardcoded stoinosti na postovete 
//        2) Poddavash tozi masiv kato parameter kum view-to (function render)
//        3) Iterirash prez masiva vuv view za da pokajesh posts v tablicata
//        $posts = array(
//            0 => array(
//                'id' => '1', 
//                'title' => 'PHP',
//                'description'=> 'Hello world',
//                'created' => '2015-12-03 12:00:00',
//            ),
//            1 => array(
//                'id' => '2', 
//                'title' => 'C++',
//                'description'=> 'C++ world',
//                'created' => '2015-12-03 13:00:00',
//            ),
//            2 => array(
//                'id' => '3', 
//                'title' => 'C#',
//                'description'=> 'C# Hello world',
//                'created' => '2015-12-03 17:00:00',
//            ),
//            3 => array(
//                'id' => '4', 
//                'title' => 'C#',
//                'description'=> 'C# Hello world',
//                'created' => '2015-12-03 17:00:00',
//            ),
//        );
        //return $this->render('index', ['posts' => $posts]);
        // 1) Napravi nov Post Model extends ActiveRecord v models folder
        // 2) Include na tozi model v PostController.php (tuk)
        // 3. $result = Post::findAll();
        // 4) var_dump($result);
        // 
        //findOne - return a single post with title Test using one() method;
        // return a single post whose ID is 123
        // SELECT * FROM `customer` WHERE `id` = 123
        //  $post2 = Post::find()->where(['id' => 10])->one();
        // var_dump($post2);
        //return all posts and order them by their IDs
        // SELECT * FROM `customer` WHERE `status` = 1 ORDER BY `id`
        //$post3 = Post::find()->where(['title' => 'Test'])->orderBy('id')->all();
        // var_dump($post3);
        //$post4 = Post::find()->where(['title' => 'Test'])->count();
        /// var_dump($post4);
        // returns a single customer whose ID is1 10
        // scalar value: the value is treated as the desired primary key value to be looked for. Yii will determine automatically which column is the primary key column by reading database schema information.
        // $post5 = Post::findOne(10);
        //echo '<pre>' . print_r($post5, true) . '</pre>';
        //returns posts which id is 10, 1, 2, or 3 
        //$post6 = Post::findAll(['title' => 'Huen']);
//      exit(var_dump($post6));
        // var_dump($post6);
//        $postWithId = Post::find() // (new \yii\db\Query())  
//                ->where(['title' => 'Test', 'id' => 275])
//                ->orderBy('id')
//                ->all(); //one();
        //var_dump($postWithId[0]->description);
        // var_dump($postWithId[0]->id);
//        $post = Post::findOne([ //or use Find All to retrieve all the records
//                    'title' => 'Test',
//                    'id' => 275
//        ]);
        //$id = $post->id;
        // $title = $post->title;
        // echo $title;
        // echo $id;

        $posts = Post::find(); // return an object
      
        $pages = new Pagination(['totalCount' => $posts->count()]);
    
        $pages->setPageSize(5);
        //sort columns asc or desc

        $sort = new Sort([
            'attributes' => [
                'title',
                'description',
                'created'
            ]
        ]);

        $models = $posts->offset($pages->offset)
                        ->limit($pages->limit)
                        ->orderBy($sort->orders)
                        ->all();
        
        return $this->render('index', ['posts' => $models, 'pages' => $pages, 'sort' => $sort]);
    }

}
