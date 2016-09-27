<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Pages */

$this->title = 'Изменить страницу: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Все страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-update">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
	<?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>