<?php
use frontend\modules\blog\models\PostCategory;
use frontend\modules\blog\models\Tags;
use yii\helpers\Html;
function rusdate($param, $time=0) {
	if(intval($time)==0)$time=time();
	$MonthNames=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
	if(strpos($param,'M')===false) return date($param, $time);
	else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
}
?>


<!-- Sidebar -->
<section id="sidebar" class="column is-4-desktop is-12-tablet is-12-mobile">
	<div class="search-box is-hidden-touch">
	<?= Html::beginForm(['/blog/search/index'], 'GET') ?>
		<p class="control has-addons">
			<input class="search-input" name="query" type="text" placeholder="Поиск">
			<button class="button button-search">
				<i class="fa fa-search"></i>
			</button>
		</p>
	<?= Html::endForm() ?>
	</div>
			
	<header class="personal-info is-hidden-touch">
		<h1 class="title logo-title">Реальная магия</h1>
		<p>Тут должен быть крутой слоган, но я его не придумал</p>
		<div class="separator"></div>
	</header>

	<?php if ($this->beginCache('categories-widget', [
		'dependency' => [
			'class' => 'yii\caching\DbDependency',
			'sql' => 'SELECT MAX(updated_at) FROM ' . PostCategory::tableName(),
		],
	])): ?>
	<?= common\widgets\CategoriesWidget::widget() ?>
	<?php $this->endCache(); endif; ?>

	<div class="popular-posts">
	<h1 class="title">Самое обсуждаемое</h1>
		<?php foreach($popular as $pop): ?>
			<article class="popular-post">
			<?php if (!empty($pop->miniature)): ?>
				<figure class="image">
				 <?= Html::a(Html::img($pop->miniature, ['class' => 'popular-post-image', 'alt' => 'Preview']), ['/blog/default/post', 'link' => $pop->link]) ?>
				</figure>
				<?php endif ?>
				<h1 class="title"><a href="#"><?= $pop->title ?></a></h1>
				<div class="popular-post-date">
					<?= rusdate('j M, Y', $pop->date); ?>
				</div>
			</article>
		<?php endforeach ?>
		<div class="separator"></div>
	</div>

	<?php if ($this->beginCache('tags-widget', [
		'dependency' => [
			'class' => 'yii\caching\DbDependency',
			'sql' => 'SELECT MAX(updated_at) FROM ' . Tags::tableName(),
		]
	])): ?>
	<?= common\widgets\TagsWidget::widget() ?>
	<?php $this->endCache(); endif; ?>

	<footer class="footer">
		<ul class="soc">
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-vk"></i></a></li>
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-instagram"></i></a></li>
		</ul>
		<p class="bottom-info">
			<span>© realmagic.ru</span>
			<span>Example@mail.ru</span>
		</p>
	</footer>
</section>
<!-- End sidebar -->