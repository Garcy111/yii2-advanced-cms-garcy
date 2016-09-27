<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Блог';
function rdate($param, $time=0) {
	if(intval($time)==0)$time=time();
	$MonthNames=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
	if(strpos($param,'M')===false) return date($param, $time);
	else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
}
?>

<div id="main" class="columns is-multiline">
<!-- Posts -->
<section id="posts" class="column is-8-desktop is-12-tablet is-12-mobile">
	<?php foreach ($posts as $post): ?>
		<?php if ($post->access == 0): ?>
		<article class="post">
			<header class="columns is-mobile post-header">
				<div class="column is-9 post-title">
					<h1 class="title"><?= Html::a($post->title, ['/blog/default/post', 'link' => $post->link]) ?></h1>
				</div>
				<div class="column is-3 post-meta">
					<div class="date"><?= rdate('j M, Y', $post->date); ?></div>
				</div>
			</header>
			<div class="post-content">
				<?php if (!empty($post->miniature)): ?>
				<figure class="image">
				 <?= Html::a(Html::img($post->miniature, ['class' => 'post-image']), ['/blog/default/post', 'link' => $post->link]) ?>
				</figure>
				<?php endif ?>
				<p class="post-desc"><?= $post->description ?></p>
				<?= Html::a(Html::button('Читать', ['class' => 'button is-outlined next-reading']), ['/blog/default/post', 'link' => $post->link]) ?>
				<ul class="stats">
					<?php foreach ($post->tags as $tag): ?>
						<li><i class="fa fa-tag"><?= Html::a('<span>'.$tag->name.'</span>', ['/blog/default/index', 'tag' => $tag->name]) ?></i></li>
					<?php endforeach ?>
					<?php if (!empty($post->category->name)): ?>
						<li><i class="fa fa-folder"><span><?= Html::a($post->category->name, ['/blog/default/index', 'ctg' => $post->category->id]) ?></span></i></li>
					<?php endif ?>
					<li>
					<div class="item-heart">
						<button class="icobutton icobutton--heart">
							<i class="fa fa-heart like" data-post-id="<?= $post->id ?>">
								<span><?= $post->likes ?></span>
							</i>
						</button>
					</div>
					</li>
					<li><i class="fa fa-comment"><span class="disqus-comment-count" data-disqus-url="<?= 'http://websnack.ru/blog/'.$post->link ?>">0</span></i></li>
				</ul>
			</div>
		</article>
		<?php endif ?>
		<?php if ($post->access == 1 && Yii::$app->user->can('admin')): ?>
		<article class="post">
			<header class="columns is-mobile post-header">
				<div class="column is-9 post-title">
					<h1 class="title"><?= Html::a($post->title, ['/blog/default/post', 'link' => $post->link]) ?></h1>
				</div>
				<div class="column is-3 post-meta">
					<div class="date"><?= rdate('j M, Y', $post->date); ?></div>
				</div>
			</header>
			<div class="post-content">
				<?php if (!empty($post->miniature)): ?>
				<figure class="image">
				 <?= Html::a(Html::img($post->miniature, ['class' => 'post-image']), ['/blog/default/post', 'link' => $post->link]) ?>
				</figure>
				<?php endif ?>
				<p class="post-desc"><?= $post->description ?></p>
				<?= Html::a(Html::button('Читать', ['class' => 'button is-outlined next-reading']), ['/blog/default/post', 'link' => $post->link]) ?>
				<ul class="stats">
					<?php foreach ($post->tags as $tag): ?>
						<li><i class="fa fa-tag"><?= Html::a('<span>'.$tag->name.'</span>', ['/blog/default/index', 'tag' => $tag->name]) ?></i></li>
					<?php endforeach ?>
					<?php if (!empty($post->category->name)): ?>
						<li><i class="fa fa-folder"><span><?= Html::a($post->category->name, ['/blog/default/index', 'ctg' => $post->category->id]) ?></span></i></li>
					<?php endif ?>
					<li>
					<div class="item-heart">
						<button class="icobutton icobutton--heart">
							<i class="fa fa-heart like" data-post-id="<?= $post->id ?>">
								<span><?= $post->likes ?></span>
							</i>
						</button>
					</div>
					</li>
					<li><i class="fa fa-comment"><span class="disqus-comment-count" data-disqus-url="<?= 'http://websnack.ru/blog/'.$post->link ?>">0</span></i></li>
				</ul>
			</div>
		</article>
		<?php endif ?>
	<?php endforeach ?>
	<?= LinkPager::widget([
		'pagination' => $pages,
	]);
?>
</section>
<!-- End posts -->
<?= $this->render('sidebar', ['popular' => $popular]) ?>
</div>