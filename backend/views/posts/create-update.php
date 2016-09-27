<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\PostCategory;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Все записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
backend\assets\TinymceAsset::register($this);
$this->registerCssFile('/admin/public/css/post.css');
$this->registerCssFile('/admin/public/libs/balloon/balloon.min.css');
$this->registerJsFile('/admin/public/js/post.js');
?>

<div class="admin-post-index">
<div class="sidebar">
<?php Pjax::begin(['enablePushState' => false, 'timeout' => 10000]) ?>
<?php $form = ActiveForm::begin([
    'id' => 'add-categoty-form',
    'options' => ['data-pjax' => true]
]); ?>
<h3>Создать категорию</h3>
<?= $form->field($model_category, 'name')->textInput(['class' => 'name_category','placeholder' => 'Имя категории'])->label(false) ?>
<?= Html::submitButton('<i class="fa fa-plus"></i>', ['class' => 'btn-add', 'title' => 'Добавить']) ?>
<?php ActiveForm::end(); ?>
<h3>Выбрать категорию</h3>
<?php $form = ActiveForm::begin([
    'id' => 'add-post-form2',
    'options' => ['data-pjax' => true]
]); ?>
<?= $form->field($model, 'category_id')->dropDownList(PostCategory::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => 'Не задано'])->label(false) ?>
<h3>Миниатюра к записи</h3>
<?= $form->field($model, 'miniature')->textInput(['placeholder' => 'Источник'])->label(false) ?>
<h3>Доступ</h3>
<?= $form->field($model, 'access')->dropDownList([0 => 'Все пользователи', 1 => 'Только администратор'])->label(false) ?>
<?php ActiveForm::end(); ?>

<?php
$clearField = <<< JS
	$('.name_category').val('');
JS;
$this->registerJs($clearField);
?>
<?php Pjax::end(); ?>

</div>
<div class="content-post">
	<h1 class="title"><?= $this->title ?></h1>
    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]); ?>

<?php $form = ActiveForm::begin([
        'id' => 'add-post-form1',
    ]); ?>

    	<?= $form->field($model, 'link')->textInput(['class' => 'titleInput' ,'placeholder' => 'Адрес'])->label(false) ?>

        <?= $form->field($model, 'title')->textInput(['class' => 'titleInput' ,'placeholder' => 'Заголовок'])->label(false) ?>

        <?= $form->field($model, 'content')->textarea()->label(false) ?>

        <?= $form->field($model, 'date')->hiddenInput(['value' => time()])->label(false) ?>
        
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <button class="btn-settings btn btn-primary"><i class="fa fa-cog"></i></button>
<?php ActiveForm::end(); ?>

<div class="additional-settings">
    <h1 class="">Дополнительные параметры</h1>
    <?php $form = ActiveForm::begin([
        'id' => 'add-post-form3'
    ]); ?>
        <h3>Краткое содержание записи: <div class="hint" data-balloon="Если поле пустое, то сработает автоподстановка." data-balloon-pos="up"><i class="fa fa-question-circle"></i></div></h3>
        <?= $form->field($model, 'description')->textarea(['class' => 'mceNoEditor'])->label(false) ?>
        <h3>Описание: <div class="hint" data-balloon="Мета тег description" data-balloon-pos="up"><i class="fa fa-question-circle"></i></div></h3>
        <?= $form->field($model, 'meta_desc')->textInput(['class' => 'titleInput'])->label(false) ?>
        <h3>Ключевые слова: <div class="hint" data-balloon="Мета тег keywords" data-balloon-pos="up"><i class="fa fa-question-circle"></i></div></h3>
        <?= $form->field($model, 'meta_keywords')->textInput(['class' => 'titleInput'])->label(false) ?>
    <?php ActiveForm::end(); ?>
</div>

<?php
$js = <<< JS
$('#add-post-form1').on('beforeSubmit', function(e){
	var \$form1 = $(this);
	var \$form2 = $('#add-post-form2');
    var \$form3 = $('#add-post-form3');
	var data1 = \$form1.serialize();
	var data2 = \$form2.serialize();
    var data3 = \$form3.serialize();
	$.post(\$form1.attr('action'), {'form1': data1, 'form2': data2, 'form3': data3})
	.done(function(result) {
		
	});
return false;
});
JS;
$this->registerJs($js);
?>
</div>
</div>