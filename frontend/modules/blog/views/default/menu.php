<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use frontend\modules\blog\models\Menu;

	$model = new Menu();
	$menu = $model->find()->all();
?>

<?php foreach($menu as $el): ?>
	<?php if (!empty($el->link)): ?>
		<li>
			<?php $style = Yii::$app->request->get('link') == $el->link ? 'menu-tab-click' : 'menu-tab' ?>

			<?= Html::a($el->name, ['/blog/pages/index', 'link' => $el->link], ['class' => $style]) ?>
		</li>
	<?php else: ?>
		<li>
			<?php $style = $el->url == '/' && empty(Yii::$app->request->get('link')) ? 'menu-tab-click' : 'menu-tab'; ?>
			<?= Html::a($el->name, Url::to($el->url), ['class' => $style]) ?>
		</li>
	<?php endif ?>
<?php endforeach ?>