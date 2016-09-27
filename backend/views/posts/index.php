<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Post;
use backend\models\PostCategory;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Все записи';
?>
<div class="admin-posts-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>
<?php Pjax::begin(['enablePushState' => false, 'timeout' => 3000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            // 'id',
            [
                'label' => 'Миниатюра',
                'contentOptions' => ['class' => 'not-set'],
                'format' => 'raw',
                'value' => function($data){
                    $img = Html::img($data->miniature,[
                        'alt'=>'Миниатюра',
                        'style' => 'width:120px;'
                    ]);
                    $data = empty($data->miniature) ? Yii::t('yii', '(not set)') : $img;
                    return $data;
                },
            ],
            [
                'attribute'=>'title',
                'label'=>'Заголовок',
            ],
            // 'content:ntext',
            [
                'attribute'=>'category_id',
                'label'=>'Категория',
                'filter' => PostCategory::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => function($data){
                    return $data->category ? $data->category->name : null;
                }
            ],
            [
                'attribute'=>'access',
                'label'=>'Доступ',
                'filter' => [0 => 'Открыт', 1 => 'Только админ.'],
                'value' => function($data){
                    return $data->access == 0 ? 'Открыт' : 'Только админ.';
                }
            ],
            [
                'attribute'=>'link',
                'label'=>'Адрес',
            ],

            [
                ['class' => 'backend\models\MyActionColumn'],
                'header' => 'Действия',
            ],
            [
                'attribute'=>'date',
                'label'=>'Создано',
                'format'=> ['date', 'dd.MM.Y, HH:mm'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>