<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php 



/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Update Post :';

//echo $createdPost;
//How to create checkboxlist with checked item 

//$list = [0 => 'PHP', 1 => 'MySQL', 2 => 'Javascript'];
//$list2 = [0,2];
//echo Html::checkboxList('CuisineId',$list2,$list); 

?>
<?php // exit(var_dump($tagsList));?>

<div class="post-form">
    <h1><?= Html::encode($this->title); ?></h1>
    <p>Please fill the following form: </p>
    <?php $form = ActiveForm::begin(); ?>
    
    <?php echo $form->field($model, 'title'); ?>
    <?php echo $form->field($model, 'description'); ?>
    <?php $tags = ArrayHelper::map($tags, 'id', 'tag');?>
    <?php $tagsList = ArrayHelper::map($tagsList, 'id', 'id');?>
    <?php $tag->id = $tagsList;?>  
    <?php // exit(var_dump($tagsList));?>
    <?php echo $form->field($tag, 'id')->checkboxList($tags);?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Update Post', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
        </div>
    </div>
</div>
<?php $form = ActiveForm::end(); ?>

