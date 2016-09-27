<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tags */

$this->title = 'Создать метку';
// $this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-create">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>