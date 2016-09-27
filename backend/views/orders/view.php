<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Orders */

$this->title = 'Заказ: ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Все заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]); ?>

   <p>
        <?= Html::a(Html::button('Изменить', ['class' => 'btn btn-primary']), ['update', 'id' => $model->id]) ?>
        <?= Html::a(Html::button('Удалить', ['class' => 'btn btn-danger']), ['delete', 'id' => $model->id], [
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            // 'user_id',
            // 'products:ntext',
            // 'quantity:ntext',
            [
                'attribute' => 'shipping',
                'value' => $model->shipping . ' руб.',
            ],
            [
                'label' => 'Итого',
                'value' => $model->total . ' руб.',
            ],
            [
                'attribute' => 'active',
                'format' => 'html',
                'value' => $model->active ? '<p class="paid">Опл.</p>': '<p class="not-paid">Не опл.</p>',
            ],
            [
                'attribute'=>'date',
                'format'=> ['date', 'dd.MM.Y, HH:mm'],
            ],
        ],
    ]) ?>

</div>
</div>