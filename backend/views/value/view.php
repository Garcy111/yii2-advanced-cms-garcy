<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Value */

$this->title = 'Просмотр';
$this->params['breadcrumbs'][] = ['label' => 'Все значения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="value-view">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]); ?>
    <p>
        <?= Html::a(Html::button('Изменить', ['class' => 'btn btn-primary']), ['update', 'product_id' => $model->product_id, 'attribute_id' => $model->attribute_id]) ?>
        <?= Html::a(Html::button('Удалить', ['class' => 'btn btn-danger']), ['delete', 'product_id' => $model->product_id, 'attribute_id' => $model->attribute_id], [
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'product_id',
                'label' => 'Продукт',
                'value' => $model->product->name,
            ],
            [
                'attribute' => 'attribute_id',
                'label' => 'Атрибут',
                'value' => $model->productAttribute->name,
            ],
            [
                'attribute' => 'value',
                'label' => 'Значение',
            ],
        ],
    ]) ?>

</div>
</div>