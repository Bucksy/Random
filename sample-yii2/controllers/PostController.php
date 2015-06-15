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
                //$comment->createdDate = $commentResult['createdDate'];
                $comment->post_id = $post->id;

//              exit(var_dump($commentResult));
                
//               exit(var_dump($comment));
               
                if ($comment->validate()) {
                    $comment->save();
                    return $this->refresh();
                } else {
                    //errors? 
//                   $errors = $comment->getErrors();
                   //TODO
                }
            }
            return $this->render('view', ['post' => $post, 'version' => $version, 'comments' => $comments, 'comment' => $comment, 'tags' => $tags]);
        }
        // return $this->render('view', ['post' => $post, 'version' => $version, 'comment' => $comment]); 
    }

    /**
     * Creates a new Post Model()
     * If creation is successfull, the browser will  redirected to the index page
     * @return mixed
     */
//    public function actionComment($id){ //id of post
//        
//    }
//    
    public function actionCreate() {
        
        $request = Yii::$app->request;
        $post = new Post();
        $tag = new Tag();
        $uploadFile = new Image();
        
        $tags = Tag::find()->asArray(true)->all(); // fetch as an array of arrays 

        if ($post->load($request->post())) {//if we have post request
        
//          exit(var_dump($_POST));
//          $uploadFile = new UploadFile();
            
            $postResult = $request->post()['Post'];
            $tagResult = $request->post()['Tag'];
//          $imageFile = $request->post()['Image']['image'];//post image
//          $imageCaption = $request->post()['Image']['caption'];//post caption
            
            $imageName = $uploadFile->image;
            
            //get the instance of the uploaded file  and save the file in uploads folder
            
            $uploadFile->file = UploadedFile::getInstance($uploadFile, 'file');
            $uploadFile->file->saveAs('uploads/'.$uploadFile->file->baseName.'.'.$uploadFile->file->extension);
            
            //save the path in the column in database with the name
            $uploadFile->image = 'uploads/'.$uploadFile->file->baseName.'.'.$uploadFile->file->extension;
            $uploadFile->save();
            
//            exit(var_dump($uploadFile->image));
           
            if ($post->validate()) {
                 $post->userId = 2; //TODO - Session_id = user_id
                 $post->save();
//               $uploadFile->save();
         
                foreach ($tagResult['tag'] as $tagId) {
                    $tagRelation = Tag::findOne($tagId);
                    $post->link('tags', $tagRelation);
                 }
                return $this->redirect('?r=post/index', 302);
            } else {
                return $this->render('create', ['model' => $post]);
            }
        }else {
               return $this->render('create', ['model' => $post, 'tags' => $tags, 'tag' => $tag, 'uploadFile' => $uploadFile]);
        }
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
        
        //$tags = Tag::find()->asArray(true)->all();
        //$tagsList = $post->getTags()->asArray(true)->all();

        if ($post == NULL) {
            throw new \Exception("The post or tags does not exist!");
        } else {
            
            $tags = Tag::find()->asArray(true)->all();
            $tagsList = $post->getTags()->asArray(true)->all();
            
            if ($request->isGet) {
                $tag = new Tag();
                return $this->render('update', ['model' => $post, 'tags' => $tags, 'tag' => $tag, 'tagsList' => $tagsList]);
            } else if ($request->isPost) {

//            exit(var_dump($_POST));
                if ($post->validate()) { //TODO with tags - from database 
                    $title = $request->post()['Post']['title']; //title from Post
                    $description = $request->post()['Post']['description']; //description from Post

                    $tags = $request->post()['Tag']['id']; //post request
                    $post->title = $title;
                    $post->description = $description;
                    $post->save();

                    $oldTags = $post->getTags()->asArray(true)->all();
                    
//                    exit(var_dump($oldTags));
                    //remove old tags
                    if (is_array($tags) && !empty($oldTags)) {
                        foreach ($oldTags as $oldTag) {
                            //  exit(var_dump($oldTag));
                            //poneje oldTag e masiv - > nie za da vruzvame dva model, masiva oldTag - > trqbva da e obekt
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
        
        if ($post == NULL) {
            throw new \Exception('The post is  empty');
        } else {
            $oldTags = $post->getTags()->asArray(true)->all();
//            exit(var_dump($oldTags));
            $post->delete();//ne e svurzan s drugite modeli, zatova nego shte iztriem
            
            foreach ($oldTags as $oldTag) {
                $oldTagRelation = Tag::findOne($oldTag);
                $post->unlink('tags', $oldTagRelation, true);
            }
            return $this->redirect('?r=post/index', 302);
        }
    }
    
    public function actionUpload(){
       
        $model = new UploadForm();
        
        $request = Yii::$app->request;
        if ($request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
           
            if ($model->file && $model->validate()) {
                $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
//                return $this->render('index');
            }
        }
        return $this->render('upload', ['model' =>  $model]);
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
        
        //exit(var_dump($posts));
        //$query = Post::find();
        //echo '<pre>' . print_r($query, true) . '</pre>';
        //exit(var_dump($query));
        //$countQuery = clone $query;
        
        $pages = new Pagination(['totalCount' => $posts->count()]);
        //exit(var_dump($pages));
        
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

        $post = Post::findOne(2);
        $tags = $post->getTags()->asArray(true)->all();
//      exit(var_dump($tags));
        
         return $this->render('index', ['posts' => $models, 'pages' => $pages, 'sort' => $sort, 'tags' => $tags, 'post' => $post]);

        //var_dump($posts);
        //echo '<pre>' . print_r($result, true) . '</pre>';
        //insert a row into table
//        $post1 = new Post();
//        $post1->title = 'NewTitle';
//        $post1->description = 'New World';
//        $post1->save();
//        $rows = Post::find()
//                ->select(['id', 'title'])
//                ->where(['description' => 'Huen'])
//                ->all();
        //  var_dump($rows);
        // $subQuery = Post::find()->select('COUNT(*)')->from('users');
        // $query = Post::find()->select(['id', 'count'=>$subQuery])->from('posts');
        //var_dump($query);
    }
    
    
}
