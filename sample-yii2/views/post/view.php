<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\DetailView;

$this->title = 'Add Comment: ';
?>

<!--<h1>Post with title <?php //echo $post->title ?> : </h1>-->
<!--<table border="1">
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td>Description</td>
        <td>Created</td>
    </tr>
    <tr>
        <td><?php// echo  $post->id ?></td>
        <td><?php //echo  $post->title ?></td>
        <td><?php //echo  $post->description ?></td>
        <td><?php //echo  $post->created;?></td>
    </tr>
</table>-->

<br/>
<br/>
<br/>

<?php
echo DetailView::widget([
    'model' => $post,
    'attributes' => [
      'title',
        'description',
        'created:datetime',
    ],
]);

foreach ($tags as $tag) {
    echo DetailView::widget([
        'model' => $tag,
        'attributes' => [
            'tag',
        ],
    ]);
}

?>
<div class="post-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $form = ActiveForm::begin();
    ?>

    <?php echo $form->field($comment, 'author'); ?>
    <?= $form->field($comment, 'comment')->textarea(); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Post', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end();?>

<?php
if (empty($comments)) {
    echo 'No comments or tags yet. Add comment or create tag';
} else {
    ?>
    <div class="comment-entry">
        <div class="comment-header">
            <h1>Comments: </h1>

                <?php
                foreach ($comments as $comment) {
                echo DetailView::widget([
                    'model' => $comment,
                    'attributes' => [
                        'author',
                        'comment',
                        'createdDate:datetime',
                    ],
                ]);
    }
    ?>
        </div>
    </div>
<?php }



