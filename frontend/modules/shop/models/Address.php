<?php

namespace frontend\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%address}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property integer $index
 * @property string $address
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'full_name', 'email', 'index', 'address'], 'required'],
            [['order_id', 'index'], 'integer'],
            [['address'], 'string'],
            [['full_name', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
            [['phone'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'full_name' => 'ФИО:',
            'email' => 'Email:',
            'phone' => 'Телефон:',
            'index' => 'Почтовый индекс:',
            'address' => 'Адрес доставки:',
        ];
    }

    public function getAddress()
    {
        $id = Yii::$app->user->identity->id;
        $order = Orders::find()->where(['user_id' => $id])->orderBy('date DESC')->one();
        if (empty($order)) {
            return $this;
        }
        $this->full_name = $order->address->full_name;
        $this->email = $order->address->email;
        $this->phone = $order->address->phone;
        $this->index = $order->address->index;
        $this->address = $order->address->address;
        return $this;
    }
}
