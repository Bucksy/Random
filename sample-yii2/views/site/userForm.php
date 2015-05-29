<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php
if (Yii::$app->session->hasFlash('success')) {
    echo "<div class='alert alert-success'>". Yii::$app->session->getFlash('success'). "</div>";
}
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->label('Your name'); ?>
<?= $form->field($model, 'email');?>

<?= Html::submitButton('Submit', ['class' => 'btn btn-success']); ?>

