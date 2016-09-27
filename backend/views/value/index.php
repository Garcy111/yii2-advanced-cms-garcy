<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Значения атрибутов';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="value-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>

   <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'product_id',
                'label' => 'Продукт',
                'value' => function($data) {
                    return $data->product->name;
                },
            ],
            [
                'attribute' => 'attribute_id',
                'label' => 'Атрибут',
                'value' => function($data) {
                    return $data->productAttribute->name;
                },
            ],
            [
                'attribute' => 'value',
                'label' => 'Значение',
            ],

            ['class' => 'backend\models\MyActionColumn'],
        ],
    ]); ?>

</div>
</div>