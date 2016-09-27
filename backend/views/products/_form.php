<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\ProductCategory;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['id' => 'main-form']); ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true])->label('Фото (Источник)') ?>

    <?= $form->field($model, 'category_id')->dropDownList(ProductCategory::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'active')->dropDownList([1 => 'Да', 0 => 'Нет']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
