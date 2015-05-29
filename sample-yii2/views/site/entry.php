<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
//The entry view displays an HTML form. 
       $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name'); ?>
        <?= $form->field($model, 'email'); ?>

<div class="form-group">
   <?= Html::submitButton('Submit');?>
</div>
<?php  ActiveForm::end(); ?>
