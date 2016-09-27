<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Атрибуты';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'label' => 'Название'
            ],

            ['class' => 'backend\models\MyActionColumn'],
        ],
    ]); ?>

</div>
</div>