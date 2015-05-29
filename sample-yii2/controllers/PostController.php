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

class PostController extends Controller {
    //get post by id 
    public function actionView($id, $version = null) {

        $request = Yii::$app->request;
        
      
        $post = Post::find()
                ->where(['id' => $id])
                ->one();
        
        $comment  = new Comment();//form
        $comments = $post->getComments()->all();//hasMany -> 
        //exit(var_dump($comments));
        
        
        //$post = Post::find($id);
        //if we dont have a post like above one .
        if ($post == NULL) {
            throw new \Exception("The post does not exist!");
        }
        
        if ($request->isPost) {
            
            $commentResult = $request->post()['Comment'];
//            exit(var_dump($commentResult));
            $comment->author = $commentResult['author'];
            $comment->comment = $commentResult['comment'];
            //$comment->createdDate = $commentResult['createdDate'];
            $comment->post_id = $post->id;
            
//          exit(var_dump($commentResult));
             
            if ($comment->validate()) {
                $comment->save();
                return $this->refresh();
            }else{
                //da pokajesh greshka
            }
        }
        return $this->render('view', ['post' => $post, 'version' => $version, 'comments' => $comments, 'comment' => $comment]); 
        // return $this->render('view', ['post' => $post, 'version' => $version, 'comment' => $comment]); 
    } 
    
    /**
     * Creates a new Post Model()
     * If creation is successfull, the browser will  redirected to the index page
     * @return mixed
     */
    
    public function actionCreate() {
        
        $request = Yii::$app->request;
        
        //exit(var_dump($request->isPost));
        //get the data form Post 
        
        $model = new Post();
        // $get = $request->get('id');
        //exit(var_dump($get));
        // $post = $request->post(); //$_POST
        // var_dump($post);
        //if($request->isPost){} or
//        if($request->isPost){
//        
//            exit(var_dump($request->post()));
//        }
        
        $tag = new Tag();
          
        $tags = Tag::find()->all();
//        exit(var_dump($tags));

        $tagsArr = [];
        
        foreach ($tags as $value) {
            //echo '<pre>' . print_r($value['tag'], true) . '</pre>';
            $tagsArr[$value->id] = $value->tag;
        }
       
//        exit(var_dump($tagsArr));
        
        if ($model->load($request->post())) {//if we have post 
            //exit('here!');
            $postResult = $request->post()['Post'];
            //exit(var_dump($postResult));
            $model->title = $postResult['title'];
            $model->description = $postResult['description'];
            $model->userId = 2;
           
            //$errors = $model->errors;
            if($model->validate()){
                $model->save();
                return $this->redirect('?r=post/index', 302);
            }else{
                return $this->render('create', ['model' => $model]);
                //exit(var_dump($model->errors));
            }
        
            //return $this->redirect('?r=post/index', 302);
        } else { // else if we have get 
            return $this->render('create', ['model' => $model, 'tags' => $tagsArr , 'tag' => $tag]);
        }
        
        /* $model = new Post();
          //if the form is submmitted by user
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //exit(var_dump($_POST));
          return $this->redirect(['view', 'title' => $model->title]);
          }else{
          $errors = $model->errors;
          return $this->render('create', ['errors'=> $errors, 'model' => $model]);
          } */
    }
    

    public function actionUpdate($id) {
        //echo '<pre>' . print_r($id, true) . '</pre>';
        // shows the form - if we have get, 
        // post - >  update and redirect

        $request = Yii::$app->request;
        $post = Post::findOne($id);
        //$title = $post['title'];
        //$description = $post['description'];

        if ($request->isGet) {
             // shows  the form , if we have get 
             
            //$model = new Post();
            //$model->title = $title;
           // $model->description = $description;

            // var_dump($post['title']);
           
            return $this->render('update', ['model' => $post]);
            
            // $post['id'];
            //  var_dump($post);
            // exit('Get');
        } else if ($request->isPost) {
            
            //echo 'update an row' in database :D ;  
            //exit('122');
           
            $title = $request->post()['Post']['title'];
            $description = $request->post()['Post']['description'];
            
            $post->title = $title;
            //exit(var_dump($post->title));
            $post->description = $description;
            $post->save();
            //exit(var_dump($post->title));
            return $this->redirect('?r=post/index',302);
        }
    }

    public function actionDelete($id) {

        $post = Post::findOne($id);
        
        if (empty($post)) {
            throw new \Exception('The post is  empty');
        }else{
             $post->delete();
             return $this->redirect('?r=post/index', 302);
        }
    }

//    public function actionComment(){
//        
//         //form
//        
//        $model = new Comment();
//        
//       // exit(var_dump($model));
//        
//        $request = Yii::$app->request;
//        
////        $post = Post::findOne($id);
//        
//        $comments = $post->comments;
//        //exit(var_dump($comments));
//        
//        return $this->render('comment' ,['model' => $model]);
//    }
    
    public function actionIndex() {
        
        $request = Yii::$app->request;
        $get = $request->get();
       // echo '<pre>' . print_r($get, true) . '</pre>';
       //// exit;
     // /  
        // $request = Yii::$app->request;
        //  $params = $request->bodyParams;
        //var_dump($params);
        //Insert a row into database 
//      $p = new Post();
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
        $post2 = Post::find()->where(['id' => 10])->one();
        // var_dump($post2);
        //return all posts and order them by their IDs
        // SELECT * FROM `customer` WHERE `status` = 1 ORDER BY `id`
        $post3 = Post::find()->where(['title' => 'Test'])->orderBy('id')->all();
        // var_dump($post3);


        $post4 = Post::find()->where(['title' => 'Test'])->count();
        // var_dump($post4);
        // returns a single customer whose ID is1 10
        // scalar value: the value is treated as the desired primary key value to be looked for. Yii will determine automatically which column is the primary key column by reading database schema information.
        $post5 = Post::findOne(10);
        //echo '<pre>' . print_r($post5, true) . '</pre>';
        //returns posts which id is 10, 1, 2, or 3 
        $post6 = Post::findAll(['title' => 'Huen']);
        // var_dump($post6);

//        $postWithId = Post::find() // (new \yii\db\Query())  
//                ->where(['title' => 'Test', 'id' => 275])
//                ->orderBy('id')
//                ->all(); //one();
        //var_dump($postWithId[0]->description);
        // var_dump($postWithId[0]->id);

        $post = Post::findOne([ //or use Find All to retrieve all the records
                    'title' => 'Test',
                    'id' => 275
        ]);

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
        $pages->setPageSize(6);
            
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
  
        //exit(var_dump($models));
        return $this->render('index', ['posts' => $models, 'pages'=> $pages, 'sort' => $sort]);

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
