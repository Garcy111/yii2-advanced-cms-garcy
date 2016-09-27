<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tags */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tags-form">

    <?php $form = ActiveForm::begin(['id' => 'main-form']); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= $form->field($model, 'updated_at')->hiddenInput(['value' => time()])->label(false) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
