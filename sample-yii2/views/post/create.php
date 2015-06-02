<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Create a Post';
//echo $createdPost;
?>
<?php
//var_dump($model)
//foreach ($tags as $value) {
//echo '<pre>' . print_r($value['tag'], true) . '</pre>'; //string
//}
?>
<?php
if ($model->errors) {
    var_dump($model->errors);
}

?>
<div class="post-form">
    <h1><?= Html::encode($this->title); ?></h1>
    <p>Please fill the following form: </p>
    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="row">
        <div class="col-lg-5">
            <?php echo $form->field($model, 'title'); ?>
            <?php echo $form->field($model, 'description')->textarea(); ?>
            <?php
            $tags = ArrayHelper::map($tags, 'tag', 'tag');
            echo $form->field($model, 'tag_list')->checkboxList($tags);
            ?>
        </div>
    </div>
    <?php
    //echo $form->field($tag, 'tag')->checkboxList(['AAA'=>'Bottle',2=>'das',3=>'Joro']);
    ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Create Post', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>