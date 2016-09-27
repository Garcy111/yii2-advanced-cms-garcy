<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Pages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Все страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-view">
<div class="content">

    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]); ?>

    <p>
        <?= Html::a(Html::button('Изменить', ['class' => 'btn btn-primary']), ['update', 'id' => $model->id]) ?>
        <?= Html::a(Html::button('Удалить', ['class' => 'btn btn-danger']), ['delete', 'id' => $model->id], [
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'link',
            [
                'attribute' => 'content',
                'format' => 'html',
            ],
            'updated_at',
        ],
    ]) ?>

</div>
</div>