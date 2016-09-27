<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TagsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Метки';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',

            ['class' => 'backend\models\MyActionColumn'],
        ],
    ]); ?>

</div>
</div>