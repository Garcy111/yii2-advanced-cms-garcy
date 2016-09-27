<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Все продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">
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
            [
                'attribute' => 'photo',
                'label' => 'Фото',
                'format' => 'html',
                'value' => $model->photo ? Html::img($model->photo,[
                        'alt'=>'Фото',
                        'style' => 'width:120px;'
                ]) : null,
            ],
            [
                'attribute' => 'category_id',
                'value' => $model->category ? $model->category->name : null,
            ],
            'name',
            'description:ntext',
            'price',
            'active:boolean',
        ],
    ]) ?>
     <p>
        <?= Html::a(Html::button('Добавить', ['class' => 'btn btn-success']), ['/admin/value/create', 'product_id' => $model->id]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getValues()->with(['productAttribute'])]),
        'summary' => '',
        'columns' => [
            [
                'attribute' => 'attribute_id',
                'value' => 'productAttribute.name',
            ],
            'value',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'controller' => '/admin/value'
            ],
        ],
    ]) ?>

</div>
</div>