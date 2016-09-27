<?php
use yii\helpers\Html;

$this->title = $page->name;
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
		<article class="post-full">
			<header class="columns is-mobile post-header">
				<div class="column is-9 post-title">
					<h1 class="title"><?= $page->name ?></h1>
				</div>
				<div class="column is-3 post-meta">
					<div class="date"><?= rdate('j M, Y', $page->updated_at); ?></div>
				</div>
			</header>
			<div class="post-content">
				<div class="full-content">
					<?= $page->content ?>
				</div>
			</div>
		</article>
</section>
<!-- End posts -->
<?= $this->render('../default/sidebar', ['popular' => $popular]) ?>
</div>