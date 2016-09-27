<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Orders */

$this->title = 'Изменить статус заказа: ' . ' ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Все заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-update">

   <div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]); ?>
   <?php $form = ActiveForm::begin(['id' => 'main-form']); ?>

    <?= $form->field($model, 'active')->dropDownList([0 => 'Не оплачено', 1 => 'Оплачено'])->label('Статус оплаты') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
