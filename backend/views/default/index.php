<?php
    use yii\helpers\Html;
    $this->title = 'Главная';
    backend\assets\ChartAsset::register($this);
?>

<div class="admin-default-index">
<div class="content">
<h1 class="title">Общая статистика</h1>

<div class="container-flex">
	<div class="flex-item stat-orders">
		<h1 class="counter"><?= $orders ?></h1>
		<h2 class="counter-text">Заказов</h2>
		<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
		<div class="more-info"><?= Html::a('Подробнее', ['/admin/orders/']) ?></div>
	</div>
	<div class="flex-item stat-payments">
		<h1 class="counter"><?= $payment ?></h1>
		<h2 class="counter-text">Платежей</h2>
		<i class="fa fa-credit-card" aria-hidden="true"></i>
		<div class="more-info"><?= Html::a('Подробнее', ['/admin/orders/']) ?></div>
	</div>
	<div class="flex-item stat-products">
		<h1 class="counter"><?= $products ?></h1>
		<h2 class="counter-text">Продуктов</h2>
		<i class="fa fa-star-o" aria-hidden="true"></i>
		<div class="more-info"><?= Html::a('Подробнее', ['/admin/products/']) ?></div>
	</div>
	<div class="flex-item stat-users">
		<h1 class="counter"><?= $users ?></h1>
		<h2 class="counter-text">Пользователей</h2>
		<i class="fa fa-user" aria-hidden="true"></i>
		<div class="more-info"><?= Html::a('Подробнее', ['/admin/users/']) ?></div>
	</div>
</div>

<h1 class="title">Аналитика продаж</h1>
<div class="wrap-analytics">
	<canvas id="sales-analytics"></canvas>
</div>

</div>
</div>