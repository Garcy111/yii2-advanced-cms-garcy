<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Pages;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Название', 'class' => 'titleInputShort'])->label(false) ?>

    <?= $form->field($model, 'link')->dropDownList(Pages::find()->select(['name', 'link'])->indexBy('link')->column(), ['prompt' => 'Страница не задана', 'class' => 'titleInputShort'])->label(false) ?>

     <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder' => 'url', 'class' => 'titleInputShort'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
