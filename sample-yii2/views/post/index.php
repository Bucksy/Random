
<?php //echo '<pre>' . print_r($posts, true) . '</pre>';
//localhost/sample-yii2/web/?r=post/view&id=1
//echo '<pre>' . print_r($post->id, true) . '</pre>';
use yii\widgets\LinkPager;
?>
<h1><a href="?r=post/create">Create a Post</a></h1>
<table border="1px">
    <tbody>
        <tr>
            <td>ID</td>
            <td><?= $sort->link('title')?></td>
            <td><?= $sort->link('description')?></td>
            <td><?= $sort->link('created')?></td>
            <td colspan="2">Actions</td>
        </tr>
        <?php 
        foreach ($posts as $post) {
            echo '<tr>'
                    . '<td>'.$post->id.'</td>'
                    . '<td><a href="?r=post/view&id='.$post->id.'">'.$post->title.'</a></td>'
                    . '<td>'.$post->description.'</td>'
                    . '<td>'.$post->created.'</td>'
                    . '<td><a href="?r=post/update&id='.$post->id.'">Update</a></td>'
                    . '<td><a href="?r=post/delete&id='.$post->id.'">Delete</a></td>'
              . '</tr>';
        }
        ?>
    </tbody>
</table>

<?php 
//echo $sort->link('description'). '|' . $sort->link('title');

echo \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
]);


//echo $name;
//echo '<pre>' . print_r($commentForm, true) . '</pre>';