<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Корзина';
common\assets\FontawesomeAsset::register($this);
common\assets\ArcticmodalAsset::register($this);
$this->registerCssFile('/public/modules/shop/styles/cart.css');
$this->registerCssFile('/public/libs/balloon/balloon.min.css');
$this->registerJsFile('/public/modules/shop/js/cart.js');

function money($money) {
    $numb = number_format($money, 3, '.', ' ');
    $numb = explode('.', $numb);
    return $numb[0];
}

?>

<div class="content">
	<table class="cart">
		<tr>
			<th>Изображение</th>
			<th>Наименование товара</th>
			<th>Описание</th>
			<th>Количество</th>
			<th>Цена</th>
			<th>Итого</th>
		</tr>
		<?php if ($cart): ?>
		<?php foreach ($cart as $row): ?>
			<tr>
				<td> <?= Html::img($row->product->photo, ['class' => 'cart-img']) ?> </td>
				<td> <?= $row->product->name ?> </td>
				<td> <?= $row->product->description ?> </td>
				<td>
				<?= Html::input('text', null, $row->quantity, ['class' => 'quantity', 'id' => 'row_' . $row->id]) ?>
				<?= Html::button('<i class="fa fa-refresh" aria-hidden="true"></i>', ['class' => 'update-quantity hint', 'data-cart-id' => $row->id, 'data-balloon' => 'Обновить', 'data-balloon-pos' => 'up']) ?>
				<?= Html::button('<i class="fa fa-times-circle" aria-hidden="true"></i>', ['class' => 'delete-product hint', 'data-cart-id' => $row->id, 'data-balloon' => 'Удалить', 'data-balloon-pos' => 'up']) ?>
				</td>
				<td> <?= money($row->product->price) ?> руб.</td>
				<td> <?= money($total[$row->id]) ?> руб.</td>
			</tr>
		<?php endforeach ?>
		</table>
		<div class="info-block">
			<table class="info">
				<tr>
					<td>Сумма: </td>
					<td>
						<?= money($summa) ?> руб.
					</td>
				</tr>
				<tr>
					<td>Доставка: </td>
					<td><?= $shipping = 250 ?> руб.</td>
				</tr>
				<tr>
					<td>Итого: </td>
					<td><?= money($summa + $shipping) ?> руб.</td>
				</tr>
				<tr>
					<td colspan="2">
						<button class="btn-send make-order">Оформить заказ</button>
					</td>
				</tr>
			</table>
		</div>
	<?php else: ?>
	</table>
	<div class="empty-cart">Корзина пуста</div>
	<?php endif ?>

<div style="display: none;">
<div class="box-modal" id="make-order-modal">
<?php $form = ActiveForm::begin([
        'id' => 'order-form',
    ]); ?>
	<?= $form->field($model, 'order_id')->hiddenInput(['value' => round(mt_rand(mt_rand(0, 10000), mt_rand(10000, 90000))*time()/1000000)])->label(false) ?>
    <?= $form->field($model, 'full_name')->textInput()->label() ?>
    <?= $form->field($model, 'email')->textInput()->label() ?>
    <?= $form->field($model, 'phone')->textInput()->label() ?>
    <?= $form->field($model, 'index')->textInput()->label() ?>
    <?= $form->field($model, 'address')->textInput()->label() ?>
	<?= Html::submitButton('Заказать', ['class' => 'btn-send']) ?>
<?php ActiveForm::end(); ?>
</div>
</div>

</div>