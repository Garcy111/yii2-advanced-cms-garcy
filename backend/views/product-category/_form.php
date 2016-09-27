<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\ProductCategory;

/* @var $this yii\web\View */
/* @var $model app\models\ProductCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(['id' => 'main-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название') ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ProductCategory::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => ''])->label('Подкатегория') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
