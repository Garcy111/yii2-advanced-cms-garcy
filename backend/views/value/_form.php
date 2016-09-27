<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Product;
use app\modules\admin\models\Attribute;

/* @var $this yii\web\View */
/* @var $model app\models\Value */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="value-form">

    <?php $form = ActiveForm::begin(['id' => 'main-form']); ?>

    <?= $form->field($model, 'product_id')->dropDownList(Product::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => ''])->label('Для продукта') ?>

    <?= $form->field($model, 'attribute_id')->dropDownList(Attribute::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => ''])->label('Атрибут') ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true])->label('Значение') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
