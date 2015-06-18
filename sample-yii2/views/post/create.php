<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Create a Post';
?>
<?php
//var_dump($tags);
//exit;
//foreach ($tags as $value) {
//echo '<pre>' . print_r($value['tag'], true) . '</pre>'; //string
//}
?>
<?php
//exit(var_dump($uploadFile));

if ($model->errors) {
    var_dump($model->errors);
}
?>
<div class="post-form">
    <h1><?= Html::encode($this->title); ?></h1>
    <p>Please fill the following form: </p>
    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    ?>
    <div class="row">
        <div class="col-lg-5">
            <?php echo $form->field($model, 'title'); ?>

            <?php echo $form->field($model, 'description')->textarea(); ?>

            <?php echo $form->field($uploadFile, 'file[]')->fileInput(['multiple' => true]); ?>
            
            <?php echo $form->field($uploadFile, 'caption'); ?>

            <?php $tags = ArrayHelper::map($tags, 'id', 'tag');
                  echo $form->field($tag, 'tag')->checkboxList($tags);
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Create Post', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>