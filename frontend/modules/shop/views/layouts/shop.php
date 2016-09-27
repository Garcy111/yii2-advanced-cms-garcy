<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\web\YiiAsset;

YiiAsset::register($this);
$this->registerCssFile('public/styles/fonts.css');
$this->registerCssFile('public/styles/main.css');
$this->registerCssFile('public/modules/shop/styles/shop.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container">
    <?php 
    	// echo app\widgets\admin\ModalWidget::widget() 
    ?>
    
    <?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>