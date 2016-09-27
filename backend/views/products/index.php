<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\ProductCategory;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>
<?php Pjax::begin(['enablePushState' => false, 'timeout' => 3000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'photo',
                'contentOptions' => ['class' => 'not-set'],
                'format' => 'raw',
                'value' => function($data){
                    $img = Html::img($data->photo,[
                        'alt'=>'Фото',
                        'style' => 'width:120px;'
                    ]);
                    $data = empty($data->photo) ? Yii::t('yii', '(not set)') : $img;
                    return $data;
                },
            ],
            [
                'attribute' => 'category_id',
                'label' => 'Категория',
                'filter' => ProductCategory::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => function($data) {
                    return $data->category ? $data->category->name : null;
                },
            ],
            [
                'attribute' => 'name',
                'label' => 'Название',
            ],
            [
                'attribute' => 'description',
                'label' => 'Описание',
            ],
            [
                'attribute' => 'price',
                'label' => 'Цена',
                'value' => function($data) {
                    return $data->price . ' руб.';
                }
            ],
            [
                'attribute' => 'active',
                'filter' => [0 => 'Нет', 1 => 'В наличии'],
                'format' => 'raw',
                'value' => function($data) {
                    switch ($data->active) {
                        case 0:
                            $value = 'Нет';
                            $class = 'status-fail';
                            break;
                        case 1:
                            $value = 'В наличии';
                            $class = 'status-success';
                            break;
                        default:
                            $value = 'Не задано';
                            $class = 'status-warning';
                            break;
                    }
                    return Html::tag('p', $value, ['class' => $class]);
                }
            ],

           [
                ['class' => 'backend\models\MyActionColumn'],
                'header' => 'Действия',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>