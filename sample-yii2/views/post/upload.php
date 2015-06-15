<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
echo  $form->field($model, 'file')->fileInput();
?>
<button>Submit</button>

<?php 
ActiveForm::end();


