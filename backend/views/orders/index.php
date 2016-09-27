<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\shop\models\Product;
use app\modules\user\models\User;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">
<div class="content">

    <h1 class="title"><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(['enablePushState' => true, 'timeout' => 3000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'order_id',
            [
                'attribute' => 'products',
                'format' => 'html',
                'value' => function($data) {
                    $result = '';
                    $products = unserialize($data->products);
                    $quantity = unserialize($data->quantity);
                    for ($i=0; count($products) > $i; $i++) {
                        $product = Product::findOne(['id' => $products[$i]]);
                        $result .=  '<div class="product">' . '<p>' . Html::a($product->name, ['/admin/products/view', 'id' => $product->id]) . '</p>' .
                        '<p>' . '<span>Описание: </span>' . $product->description . '</p>' .
                        '<p>' . '<span>Цена: </span>' . $product->price . ' руб.</p>' .
                        '<p>' . '<span>Количество: </span>' . $quantity[$i] . ' (шт.)</p></div>';
                    }
                    return '<div class="products">' . $result . '</div>';
                },
            ],
            [
                'label' => 'Адрес доставки',
                'format' => 'html',
                'value' => function($data) {
                    $address = '<div class="address">' .
                    '<p>' . '<span>Имя: </span>' . $data->address['full_name'] . '</p>' .
                    '<p>' . '<span>Email: </span>' . $data->address['email'] . '</p>' .
                    '<p>' . '<span>Телефон: </span>' . $data->address['phone'] . '</p>' .
                    '<p>' . '<span>Почтовый индекс: </span>' . $data->address['index'] . '</p>' .
                    '<p>' . '<span>Адрес доставки: </span>' . $data->address['address'] . '</p>' .
                    '</div>';
                    return $address;
                },
            ],
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value' => function($data) {
                    return empty($data->user_id) ? 'Гость' : Html::a($data->user->username, ['/admin/users/view', 'id' => $data->user->id]);
                },
            ],
            [
                'attribute' => 'shipping',
                'value' => function($data) {
                    return $data->shipping . ' руб.';
                },
            ],
            [
                'label' => 'Итого',
                'value' => function($data) {
                    return $data->total . ' руб.';
                },
            ],
            [
                'attribute'=>'active',
                'format' => 'html',
                'value'=> function($data) {
                    return $data->active ? '<p class="status-success">Опл.</p>': '<p class="status-fail">Не опл.</p>';
                },
                'filter' => [0 => 'Не оплачено', 1 => 'Оплачено'],
            ],

            [
                ['class' => 'backend\models\MyActionColumn'],
            ],
            [
                'attribute'=>'date',
                'format'=> ['date', 'dd.MM.Y, HH:mm'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>