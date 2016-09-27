<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\modules\admin\models\Tags;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Все записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
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
            [
                'attribute' => 'miniature',
                'label' => 'Миниатюра',
                'format' => 'html',
                'value' => $model->miniature ? Html::img($model->miniature,[
                        'alt'=>'Миниатюра',
                        'style' => 'width:120px;'
                ]) : null,
            ],
            [
                'attribute' => 'category_id',
                'label' => 'Категория',
                'value' => $model->category ? $model->category->name : null,
            ],
            [
                'attribute' => 'title',
                'label' => 'Заголовок',
            ],
            [
                'attribute' => 'link',
                'label' => 'Адрес',
            ],
            [
                'attribute'=>'date',
                'label'=>'Создано',
                'format'=> ['date', 'dd.MM.Y, HH:mm'],
            ],
            [
                'attribute' => 'content',
                'label' => 'Содержимое',
                'format' => 'html',
            ],
            [
                'attribute' => 'likes',
                'label' => 'Лайков',
            ],
            [
                'attribute' => 'views',
                'label' => 'Просмотров',
            ],
            [
                'attribute' => 'comments',
                'label' => 'Комментарий',
            ],
            [
                'attribute' => 'meta_desc',
                'label' => 'Описание',
            ],
            [
                'attribute' => 'meta_keywords',
                'label' => 'Ключевые слова',
            ],
        ],
    ]) ?>

<?php Pjax::begin(['enablePushState' => false, 'timeout' => 10000]) ?>
<h1 class="title">Добавить метку к записи</h1>
    <?php $form = ActiveForm::begin([
        'id' => 'add-tag-form',
        'options' => ['data-pjax' => true]
    ]); ?>
    
    <?= $form->field($tags, 'name')->dropDownList(Tags::find()->asArray()->select('name')->indexBy('name')->column())->label(false) ?>
    <?= Html::submitButton('Добавить', ['class' => '', 'title' => 'Добавить']) ?>

    <?php ActiveForm::end(); ?>


<?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getTags()]),
        'summary' => '',
        'columns' => [
            'name',
            [
                'header' => 'Действия',
                'format' => 'raw',
                'value' => function($data) use ($model) {
                    return Html::button('Удалить', [
                        'class' => 'del-tag',
                        'data-post-id' => $model->id,
                        'data-tag-id' => $data->id,
                    ]);
                }
            ],
        ],
    ]) ?>

<?php Pjax::end(); ?>

</div>
</div>