<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            // 'id',
            [
                'attribute' => 'name',
                'label' => 'Категория',
            ],
            [
                'attribute' => 'parent_id',
                'label' => 'Подкатегория',
                'value' => function($category) {
                    return $category->parent ? $category->parent->name : null;
                },
            ],

            ['class' => 'backend\models\MyActionColumn'],
        ],
    ]); ?>

</div>
</div>