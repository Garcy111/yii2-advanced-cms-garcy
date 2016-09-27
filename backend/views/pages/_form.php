<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
app\assets\TinymceAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'link')->textInput(['maxlength' => true, 'class' => 'titleInput', 'placeholder' => 'Адрес'])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'titleInput', 'placeholder' => 'Название'])->label(false) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
