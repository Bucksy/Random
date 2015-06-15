<?php 
use yii\widgets\LinkPager;//Pagination
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Post;

$this->context = 'Actions';
?>
<h1><a href="?r=post/create">Create Post</a></h1>
<h1><a href="?r=tag/create">Create Tag</a></h1>
<?php

$dataProvider = new ActiveDataProvider([
    'query' => Post::find(),
     'sort' => [
       //Set the default sort by title ASC and created date DESC
         'defaultOrder' => [
               'title' => SORT_ASC,
               'created' => SORT_ASC
         ]
     ],
    'pagination' => [
        'pageSize' => 5,
    ]
]);

//get the posts in the current page
$posts = $dataProvider->getModels();

//exit(var_dump($posts));

//exit(var_dump($dataProvider));

//ActionColumn 

//echo GridView::widget([
//    'dataProvider' => $dataProvider,
//    'columns' => [
//        'title',
//        'description',
//        'created',
//        'userId',
//        ['class' => 'yii\grid\ActionColumn'],
//        //you may configure additional properties here.
//    ]
//]);



//combine two column widget in one :)
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
            'title',
            'description',
            'created',
        ['class' => 'yii\grid\ActionColumn' ,'header' => 'Actions'],
    ]
]);

//Data Columns

//Grid columns - >  which columns to show and which not
//echo GridView::widget([
//    'dataProvider' => $dataProvider,
//    'columns' => [
//        ['class' =>'yii\grid\SerialColumn'],
//        'title',
//        [
//            'class' => 'yii\grid\DataColumn',
//            'value' => function($post){
//               return $post->title;
//            }
//        ],
//        'description',
//        'created',
//        'userId'
//    ],
//]);
        
?>
<!--<table border="1px">
    <tbody>
        <tr>
            <td>ID</td>
            <td><?php //echo $sort->link('title')?></td>
            <td><?php// echo $sort->link('description')?></td>
            <td><?php //echo $sort->link('created')?></td>
            <td colspan="3">Actions</td>
        </tr>
        <?php 
//        foreach ($posts as $post) {
//            echo '<tr>'
//                    . '<td>'.$post->id.'</td>'
//                    . '<td>'.$post->title.'</td>'
//                    . '<td>'.$post->description.'</td>'
//                    . '<td>'.$post->created.'</td>'
//                    . '<td><a href="?r=post/view&id='.$post->id.'">View</a></td>'
//                    . '<td><a href="?r=post/update&id='.$post->id.'">Update</a></td>'
//                    . '<td><a href="?r=post/delete&id='.$post->id.'">Delete</a></td>'
//              . '</tr>';
//        }
        ?>
    </tbody>
</table>-->

<?php

//echo LinkPager::widget([
//    'pagination' => $pages,
//]);
