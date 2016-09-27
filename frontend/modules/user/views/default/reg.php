<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/public/modules/user/css/reg.css', $options = [
    'depends' => [
        'frontend\assets\MainAsset'
        ]
    ]);

$siteKey = Yii::$app->reCaptcha->siteKey;

?>
<div class="user-default-reg">
<div class="wrapper-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'reg-form',
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Логин'])->label(false) ?>

        <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Повторите пароль'])->label(false) ?>

        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>

       <?= $form->field($model, 'reCaptcha', ['enableClientValidation' => false])->widget(
       \himiklab\yii2\recaptcha\ReCaptcha::className())->label(false) ?>

        <div class="form-group">
                <?= Html::submitButton('Зарегистироваться', ['class' => 'btn-send', 'name' => 'reg-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>