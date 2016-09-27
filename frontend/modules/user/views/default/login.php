<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Войти';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/public/modules/user/css/login.css', $options = [
    'depends' => [
        'frontend\assets\MainAsset',
        'frontend\assets\EauthAsset',
        ]
    ]);
?>
<div class="user-default-login">
<div class="wrapper-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= \nodge\eauth\Widget::widget(array('action' => '/user/default/login')); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Логин'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

        <?= $form->field($model, 'activation')->hiddenInput(['value' => 'activation'])->label(false) ?>
        <?= $form->field($model, 'access')->hiddenInput(['value' => 'access'])->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'rememberMe']) ?>
        <?= Html::a('Забыли пароль?', ['/user/default/recovery'], ['class' => 'recovery-password']); ?>

        <div class="form-group">
                <?= Html::submitButton('Войти', ['class' => 'btn-send', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>