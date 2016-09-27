<?php
	use yii\helpers\Html;
?>
<div class="search-result">
<?php if (!empty($result)): ?>
<h1 class="title-search">По запросу "<?= Yii::$app->request->get('query') ?>" найдено:</h1>
<?php foreach ($result as $post): ?>
	<div class="search-item">
		<h1 class="title"><?= Html::a($post['title'], ['/blog/default/post', 'link' => $post['link']]) ?></h1>
		<p class="description"><?= $post['description'] ?></p>
	</div>
<?php endforeach ?>
<?php else: ?>
	<p class="no-result">По вашему запросу ничего не найдено :(</p>
<?php endif ?>
</div>