<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create tag : ';

?>

<h1><?php echo Html::encode($this->title); ?></h1>

<?php 

?>
<div class="tag-form post-form">
    <?php 
    $form = ActiveForm::begin();
    echo $form->field($model, 'tag');
    ?>
     <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Create Tag', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>
</div>
<?php 
    ActiveForm::end();
?>