<?php

namespace frontend\modules\shop\controllers;

use frontend\modules\shop\models\Product;
use frontend\modules\shop\models\Cart;
use frontend\modules\shop\models\Address;
use frontend\modules\shop\models\Orders;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    public function actionIndex()
    {
    	$products = Product::find()->where(['active' => 1])->all();
        return $this->render('index', ['products' => $products]);
    }

    public function actionCart()
    {
        $model = new Address();
        // Автозаполнение
        if (!Yii::$app->user->isGuest) {
            $model = $model->getAddress();
        }

        $cart = new Cart();
        $cart = $cart->getCart();

        $total = [];
        $summa = 0;
        if ($cart) {
            for ($total=[],$i=$summa=0; count($cart) > $i; $i++) {
                $quantity[$cart[$i]->id] = $cart[$i]->quantity;
                $total[$cart[$i]->id] = $cart[$i]->product->price * $quantity[$cart[$i]->id];
                $summa += $total[$cart[$i]->id];
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $order = new Orders();
            $order_id = $model->order_id;
            $order->saveOrder($cart, $order_id);
            $model->save();
            Yii::$app->session->setFlash('success', 'Ваш заказ принят.');
            $cart_id = Yii::$app->session->get('cart_id');
            Cart::findOne(['cart_id' => $cart_id])->delete();
            return $this->refresh();
        }
    	return $this->render('cart', ['cart' => $cart, 'total' => $total, 'summa' => $summa, 'model' => $model]);
    }

    public function actionAddCart()
    {
    	$model = new Cart();
    	$product_id = Yii::$app->request->post('id');
    	if (!empty($product_id)) {
    		$model->addCart($product_id);
    	}
    }

     public function actionUpdateQuantityProduct()
    {
    	$model = new Cart();
    	$id = Yii::$app->request->post('id');
    	$quantity = Yii::$app->request->post('quantity');
    	if (!empty($id)) {
    		$model->updateQuantutyProduct($id, $quantity);
    	}
    }

     public function actionDeleteProduct()
    {
    	$id = Yii::$app->request->post('id');
    	if (!empty($id)) {
    		Cart::findOne(['id' => $id])->delete();
    	}
    }
}