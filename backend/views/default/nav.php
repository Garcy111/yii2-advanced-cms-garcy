<?php
    use yii\helpers\Html;

    $controller = $this->context->action->controller->id;
    $route = $this->context->action->uniqueId;
?>
<nav>
<ul class="nav">

	<div class="profile">
		<?php $user = Yii::$app->user->identity; ?>
		<?= Html::img($user->avatar, ['class' => 'profile-avatar']) ?>
		<?= '<h1 class="profile-username">' . $user->username . '</h1>' ?>
		<p class="profile-status"><span class="ind"></span> Online</p>
	</div>

	<li <?php if ($route === 'default/index'): ?> class="click" <?php endif?>>
		<?= Html::a('<i class="fa fa-home" aria-hidden="true"></i> Главная', ['/']); ?>
	</li>

	<li <?php if ($route === 'menu/index'): ?> class="click" <?php endif?>>
		<?= Html::a('<i class="fa fa-bars" aria-hidden="true"></i> Меню', ['/menu']); ?>
	</li>

	<!-- Posts -->
	<div class="nav-part">
	<div class="nav-parent">
		<li <?php if ($controller == 'posts' || $controller == 'post-categories'): ?> class="click" <?php endif?>>
			<?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Записи <i class="fa fa-angle-right" aria-hidden="true"></i>', ['/posts']); ?>
		</li>
	</div>
	<div class="nav-child">
		<li <?php if ($route === 'posts/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Все записи', ['/posts']); ?>
		</li>
		<li <?php if ($route === 'posts/create'): ?> class="click" <?php endif?>>
			<?= Html::a('Создать запись', ['/posts/create']); ?>
		</li>
		<li <?php if ($route === 'post-categories/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Категории', ['/post-categories']); ?>
		</li>
		<li <?php if ($route === 'tags/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Метки', ['/tags']); ?>
		</li>
	</div>
	</div>
	<!-- End posts -->

	<!-- Products -->
	<div class="nav-part">
	<div class="nav-parent">
		<li <?php if ($controller == 'products' || $controller == 'product-category' || $controller == 'attribute' || $controller == 'value'): ?> class="click" <?php endif?>>
			<?= Html::a('<i class="fa fa-product-hunt" aria-hidden="true"></i> Продукты <i class="fa fa-angle-right" aria-hidden="true"></i>', ['/products']); ?>
		</li>
	</div>
	<div class="nav-child">
		<li <?php if ($route === 'products/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Все продукты', ['/products']); ?>
		</li>
		<li <?php if ($route === 'products/create'): ?> class="click" <?php endif?>>
			<?= Html::a('Создать продукт', ['/products/create']); ?>
		</li>
		<li <?php if ($route === 'product-category/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Категории', ['/product-category']); ?>
		</li>
		<li <?php if ($route === 'attribute/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Атрибуты', ['/attribute']); ?>
		</li>
		<li <?php if ($route === 'value/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Значения', ['/value']); ?>
		</li>
	</div>
	</div>
	<!-- End products -->

	<li <?php if ($controller == 'orders'): ?> class="click" <?php endif?>>
		<?= Html::a('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Заказы', ['/orders']); ?>
	</li>

	<li <?php if ($route === 'pages/index'): ?> class="click" <?php endif?>>
		<?= Html::a('<i class="fa fa-file-text" aria-hidden="true"></i> Страницы', ['/pages']); ?>
	</li>

	<div class="nav-part">
	<div class="nav-parent">
		<li <?php if ($controller == 'users'): ?> class="click" <?php endif?>>
			<?= Html::a('<i class="fa fa-user"></i> Пользователи <i class="fa fa-angle-right" aria-hidden="true"></i>', ['/users']); ?>
		</li>
	</div>
	<div class="nav-child">
		<li <?php if ($route === 'users/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Все пользователи', ['/users']); ?>
		</li>
		<li <?php if ($route === 'users/create'): ?> class="click" <?php endif?>>
			<?= Html::a('Создать пользователя', ['/users/create']); ?>
		</li>
	</div>
	</div>
</ul>
</nav>