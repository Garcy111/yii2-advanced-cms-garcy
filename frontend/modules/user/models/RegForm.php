<?php

namespace frontend\modules\user\models;

use Yii;
use yii\base\Model;
use frontend\modules\admin\models\Notification;

class RegForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $email;
    public $reCaptcha;
    public $role;
    public $date;

    private $_user = false;

    const SCENARIO_REGISTER = 'reg';
    const SCENARIO_REGISTER_IN_AP = 'reg_in_adminpanel';

    public function scenarios()
    {
        return [
            self::SCENARIO_REGISTER => [
                'id',
                'username',
                'password',
                'password_repeat',
                'email',
                'reCaptcha',
                'date',
            ],
            self::SCENARIO_REGISTER_IN_AP => [
                'id',
                'username',
                'password',
                'password_repeat',
                'email',
                'role',
                'date',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat', 'email'], 'required', 'message' => 'Поле должно быть заполнено'],
            ['password', 'compare', 'message' => 'Пароли не совпадают'],
            [['date', 'role'], 'safe'],
            ['password_repeat', 'string', 'length' => [6, 25], 'tooShort' => 'Пароль не должен быть меньше 6 символов', 'tooLong' => 'Пароль не должен привышать 25 символов'],
            ['email', 'email', 'message' => 'Введите коректный email адрес'],
            ['username', 'match', 'pattern' => '/^([a-zA-Z0-9_]{3,25})?$/', 'message' => 'Только буквы (A-Z a-z) и цифры (0-9), не меньше 3 и не больше 25 символов'],
            ['username', 'validateUsername'],
            ['email', 'validateEmail'],
            // reCaptcha
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LdL_woTAAAAAC9dD9eFsQhnJIY9xpN8nVJKAyfK', 'message' => 'Необходимо разгадать капчу'],
        ];
    }

    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user) {
                $this->addError($attribute, 'Пользователь с таким логином уже существует');
            }
        }
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(['email' => $this->email]);
            if ($user) {
                $this->addError($attribute, 'Пользователь с таким Email адресом уже существует');
            }
        }
    }

    public function attributeLabels() {
        return [
            'username' => 'Логин:',
            'password' => 'Повторите пароль:',
            'password_repeat' => 'Пароль:',
            'email' => 'Email:',
            'reCaptcha' => '',
        ];
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function saveUser()
    {
        $user = new User();
        $user->username = $this->username;
        $user->password = $this->hashPassword($this->password);
        $user->email = $this->email;
        $user->authKey = $this->generateRandomString();
        $user->activation = $this->generateRandomString();
        $user->date = time();
        if ($user->save()) {
            $auth = Yii::$app->getAuthManager();
            $role = !empty($this->role) ? $this->role : 'user';
            $auth->assign($auth->getRole($role), $user->id);
            // A notification for admin panel
            $notification = new Notification();
            $notification->name = 'Новый пользователь: ' . $this->username;
            $notification->link = '/admin/users/view/?id=' . $user->id;
            $notification->date = date("d/m/Y, H:i");
            $notification->save();
        }
    }

    public function sendEmailActivation()
    {
        $username = $this->username;
        $email = $this->email;

        $user = User::findOne(['username' => $username]);
        if ($user):
        return Yii::$app->mailer->compose('activationUser', ['user' => $user])
                ->setFrom([Yii::$app->params['supportEmail'] => 'Сообщение об активации'])
                ->setTo($email)
                ->setSubject('Активация на сайте')
                ->send();
        endif;
        return false;
    }

    public function generateRandomString()
    {
        return Yii::$app->getSecurity()->generateRandomString();
    }

    public function hashPassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

}