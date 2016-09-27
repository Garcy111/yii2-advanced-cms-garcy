<?php

namespace frontend\modules\shop\models;

use \backend\models\Notification;
use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property string $products
 * @property string $quantity
 * @property integer $total
 * @property integer $shipping
 * @property integer $active
 * @property integer $date
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'products', 'quantity', 'total', 'date'], 'required'],
            [['order_id', 'user_id', 'shipping', 'active', 'total', 'date'], 'integer'],
            [['products', 'quantity'], 'string']
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
            'user_id' => 'User ID',
            'products' => 'Products',
            'quantity' => 'Quantity',
            'total' => 'Total',
            'shipping' => 'Shipping',
            'active' => 'Active',
            'date' => 'Date',
        ];
    }

    public function saveOrder($cart, $order_id, $shipping=250)
    {
        $total = 0;
        for ($i=0; count($cart) > $i; $i++) {
            $products[$i] = $cart[$i]->product_id;
            $quantity[$i] = $cart[$i]->quantity;
            $total += $cart[$i]->product->price * $cart[$i]->quantity;
        }
        $products = serialize($products);
        $quantity = serialize($quantity);
        $this->order_id = $order_id;
        if (!Yii::$app->user->isGuest) {
            $this->user_id = Yii::$app->user->identity->id;
        }
        $this->products = $products;
        $this->quantity = $quantity;
        $this->shipping = $shipping;
        $this->total = $total + $shipping;
        $this->date = time();
        if ($this->save()) {
            // A notification for admin panel
            $notification = new Notification();
            $notification->name = 'Новый заказ: ' . $this->order_id;
            $notification->link = '/admin/orders/view/?id=' . $this->id;
            $notification->date = date("d/m/Y, h:i");
            $notification->save();
        }
    }

    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['order_id' => 'order_id']);
    }
}
