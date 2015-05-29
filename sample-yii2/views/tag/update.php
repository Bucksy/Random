<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<?php 



/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Update Tag :';

//echo $createdPost;

?>
<?php// var_dump($model); ?>


<div class="post-form">
    <h1><?= Html::encode($this->title); ?></h1>
    <p>Please fill the following form: </p>
    <?php $form = ActiveForm::begin(
//    ['id' => 'login-form',
//        'options' => ['class' => 'form-horizontal'],
//        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 control-label'],
//        ],
//    ]
            ); ?>
    
    <?= $form->field($model, 'tag'); ?>

    
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Update Tag', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
        </div>
    </div>
</div>

<?php $form = ActiveForm::end(); ?>
