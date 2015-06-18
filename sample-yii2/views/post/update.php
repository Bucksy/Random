<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php 


//exit(var_dump($uploadFile));
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
<p id="demo"></p>
<?php // exit(var_dump($images));?>
<div class="post-form">
    <h1><?= Html::encode($this->title); ?></h1>
    <p>Please fill the following form: </p>
    <?php $form = ActiveForm::begin(); ?>
    
    <?php echo $form->field($model, 'title'); ?>
    <?php echo $form->field($model, 'description'); ?>
    <?php ?>
    <?php $tags = ArrayHelper::map($tags, 'id', 'tag');?>
    
    <?php $tagsList = ArrayHelper::map($tagsList, 'id', 'id');?>
    <?php $tag->id = $tagsList; ?>
    <?php echo $form->field($tag, 'id')->checkboxList($tags);?>
  
    <?php
    foreach ($images as $image) {
        echo '<a href="' . $image['image'] . '"><img src="' . $image['image'] . '" width="150px" height="150px" padding="100px"/></a>';
        ?>
          <a href="index.php?r=image/delete&id=<?php echo $image['id'] ?>" onclick="return confirm('Are you sure you want to delele this item');">
            <span class="glyphicon glyphicon-trash"></span>
         </a>
        <?php
        //Captions - HERE !!!!
        //TODO - sloji captions here!!!!!!!
    }
    ?>
    <?php echo $form->field($uploadFile, 'file[]')->fileInput(['multiple' => true]);?>
    <?php echo  $form->field($uploadFile, 'caption');?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Update Post', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
        </div>
    </div>
</div>
<?php $form = ActiveForm::end(); ?>

