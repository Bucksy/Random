<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Share your thoughts: ';
//echo $name;
//echo $id;
//echo '<pre>' . print_r($post->id, true) . '</pre>';
//echo '<pre>' . print_r($post->title, true) . '</pre>';
//echo '<pre>' . print_r($post->description, true) . '</pre>';
//echo '<pre>' . print_r($post->created, true) . '</pre>';
//echo '<pre>' . print_r($post->userId, true) . '</pre>';

var_dump($tags);
?>
<h1>Post with title <?= $post->title?> : </h1>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td>Description</td>
        <td>Created</td>
    </tr>
    <tr>
        <td><?= $post->id?></td>
        <td><?= $post->title?></td>
        <td><?= $post->description?></td>
        <td><?= $post->created?></td>
    </tr>
</table>



<div class="post-form">
    <h1><?= Html::encode($this->title)?></h1>
    <?php
    $form = ActiveForm::begin();
    ?>

    <?php echo $form->field($comment, 'author'); ?>
    <?= $form->field($comment, 'comment')->textarea();?>
  
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Post', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
<br/>
<br/>
<br/>

<h1>Comments: </h1>

<table border="1">
    <tr>
        <td><b>Author</b></td>
        <td><b>Comment</b></td>
        <td><b>Created at</b></td>
    </tr>
<?php

foreach ($comments as $comment) {
     echo '<tr>'
    . '<td>'.$comment['author'].'</td>'
    . '<td>'.$comment['comment'].'</td>'
    . '<td>'.$comment['createdDate'].'</td>'
    . '</tr>';    
}

?>
</table>
<div class="comment-entry">
    <div class="comment-header">
        
    </div>
</div>
<?php

