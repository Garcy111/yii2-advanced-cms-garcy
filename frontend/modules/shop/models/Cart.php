<?php

namespace frontend\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property integer $id
 * @property string $cart_id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $quantity
 *
 * @property Products $product
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_id', 'product_id'], 'required'],
            [['user_id', 'product_id', 'quantity'], 'integer'],
            ['quantity', 'integer', 'max' => 50, 'min' => 1],
            [['cart_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cart_id' => 'Cart ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
        ];
    }

    public function addCart($product_id)
    {
        $cart_id = $this->getCartId();
        if (!$cart_id) {
            $cart_id = $this->setCartId();
        }
        $this->cart_id = $cart_id;
        if (!Yii::$app->user->isGuest) {
            $this->user_id = Yii::$app->user->identity->id;
        }
        $this->product_id = $product_id;
        $this->save(false);
    }
    
    public function getCartId()
    {
        $session = Yii::$app->session;
        $cookies = Yii::$app->request->cookies;
        if (!empty($session->get('cart_id'))) {
            return $session->get('cart_id');
        } elseif (!empty($cookies->get('cart_id'))) {
            $cart_id = $cookies->get('cart_id');
            $session->set('cart_id', $cart_id);
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'cart_id',
                'value' => $cart_id,
                'expire' => time() + 604800,
            ]));
            return $cart_id;
        } else return false;
    }

    public function setCartId()
    {
        $session = Yii::$app->session;
        $cookies = Yii::$app->response->cookies;

        $cart_id = Yii::$app->getSecurity()->generateRandomString();

        $session->set('cart_id', $cart_id);
        $cookies->add(new \yii\web\Cookie([
            'name' => 'cart_id',
            'value' => $cart_id,
            'expire' => time() + 604800,
        ]));
        return $cart_id;
    }

    public function getCart()
    {
        $cart_id = $this->getCartId();
        if (!Yii::$app->user->isGuest) {
            $id = Yii::$app->user->identity->id;
            return self::find()->where(['user_id' => $id])->orderBy('id DESC')->all();
        }
        if ($cart_id) {
            return self::find()->where(['cart_id' => $cart_id])->orderBy('id DESC')->all();
        }
        return false;
    }

    public function updateQuantutyProduct($id, $quantity)
    {
        $row = self::findOne(['id' => $id]);
        $row->quantity = $quantity;
        $row->save();
    }

    public function money($money)
    {
        $numb = number_format($money, 3, '.', ' ');
        $numb = explode('.', $numb);
        return $numb[0];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
