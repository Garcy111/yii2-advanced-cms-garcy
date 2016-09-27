<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Attribute */

$this->title = 'Создать атрибут';
$this->params['breadcrumbs'][] = ['label' => 'Все атрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-create">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
	<?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>