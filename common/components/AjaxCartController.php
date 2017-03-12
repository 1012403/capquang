<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use yii\filters\AccessControl;
use yii\bootstrap\Alert;
use Yii;
use common\models\Product;
use common\models\Cart;
use common\models\CartProduct;

/**
 * Description of CartController
 *
 * @author Sh1a0
 */
class AjaxCartController extends \yii\web\Controller {

    public $enableCsrfValidation = false;
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    public function actionGetCartInfo() {
        $sessionCartProducts = Yii::$app->session->get('current_cart_products');
        $sessionProducts = array();
        if (!empty($sessionCartProducts['products'])) {
            $sessionProducts = $sessionCartProducts['products'];
        }
        $cartProducts = array();
        if (count($sessionProducts) > 0) {
            foreach ($sessionProducts as $id => $sessionProduct) {
                $product = Product::findOne(['id' => $id]);
                if ($sessionProduct['quantity'] < 0 || $product->price < 0) {
                    continue;
                }
                $model = new CartProduct();
                $model->product_id = $product->id;
                $model->quantity = $sessionProduct['quantity'];
                $model->price = $product->price;
                $model->discount = $product->old_price - $product->price;
                $model->discount = $model->discount > 0 ? $model->discount : 0;
                $model->total_price = $model->quantity * $model->price;
                $cartProducts[] = $model;
            }
        }
        list($totalDiscount, $totalPrice, $cartQuantity) = $this->caculateCartProducts($cartProducts);
        return $this->renderAjax("_cart-popup", ['cartProducts' => $cartProducts, 'totalPrice' => $totalPrice,
            'totalDiscount' => $totalDiscount, 'cartQuantity' => $cartQuantity]);
    }
    
    /**
     * @param CartProduct[] $cartProducts
     * @return []
     */
    protected function caculateCartProducts($cartProducts) {
        $cartQuantity = 0;
        $totalPrice = 0;
        $totalDiscount = 0;
        foreach ($cartProducts as $cartProduct) {
            $totalDiscount += $cartProduct->discount;
            $totalPrice += $cartProduct->total_price;
            $cartQuantity += 1;
        }
        return [$totalDiscount, $totalPrice, $cartQuantity];
    }

    public function actionAddToCart($product_id) {
        $message = "";
        $currentCartProducts = Yii::$app->session->get('current_cart_products');
        if (!isset($currentCartProducts['products'])) {
            $currentCartProducts['products'] = [];
        }
        $cartProducts = $currentCartProducts['products'];
        $product = Product::findOne(['id' => $product_id]);
        foreach ($cartProducts as $cartProduct) {
        }
        if (isset($cartProducts[$product_id])) {
            $cartProducts[$product_id]['quantity'] += 1;
        } else {
            $cartProducts[$product_id]['quantity'] = 1;
        }
        $currentCartProducts['products'] = $cartProducts;
        Yii::$app->session->set('current_cart_products', $currentCartProducts);
        return $this->actionGetCartInfo();
    }

    public function actionDeleteCart() {
        $product_id = Yii::$app->getRequest()->getBodyParam("product_id");
        $cartProducts = Yii::$app->session->get('current_cart_products');
        $message = "";
        if (isset($cartProducts['products']) && isset($cartProducts['products'][$product_id])) {
            unset($cartProducts['products'][$product_id]);
            $product = Product::findOne(['id' => $product_id]);
            $message = 'Xóa sản phẩm "' + $product->name + '" từ giỏ hàng thành công';
        }
        Yii::$app->session->set('current_cart_products', $cartProducts);
        return $this->actionGetCartInfo();
    }

    public function actionUpdateQuantityCart() {
        $product_id = Yii::$app->getRequest()->getBodyParam("product_id");
        $quantity = Yii::$app->getRequest()->getBodyParam("quantity");

        $message = "";
        $currentCartProducts = Yii::$app->session->get('current_cart_products');
        if (!isset($currentCartProducts['products'])) {
            $currentCartProducts['products'] = [];
        }
        $cartProducts = $currentCartProducts['products'];
        if (isset($cartProducts[$product_id])) {
            $cartProducts[$product_id]['quantity'] = $quantity;
        }

        $currentCartProducts['products'] = $cartProducts;
        Yii::$app->session->set('current_cart_products', $currentCartProducts);
        return $this->actionGetCartInfo();
    }
    
    public function actionGetTotalQuantityProducts() {
        $currentCartProducts = Yii::$app->session->get('current_cart_products');
        if (!isset($currentCartProducts['products'])) {
            $currentCartProducts['products'] = [];
        }
        $cartQuantity = 0;
        foreach ($currentCartProducts['products'] as $cartProduct) {
            $cartQuantity += 1;
        }
        echo $cartQuantity;
    }
    
    public function actionCheckout() {
        $sessionCartProducts = Yii::$app->session->get('current_cart_products');
        $sessionProducts = array();
        if (!empty($sessionCartProducts['products'])) {
            $sessionProducts = $sessionCartProducts['products'];
        }
        $cart = new Cart();
        $cartProducts = array();
        if (count($sessionProducts) > 0) {
            foreach ($sessionProducts as $id => $sessionProduct) {
                $product = Product::findOne(['id' => $id]);
                if ($sessionProduct['quantity'] < 0 || $product->price < 0) {
                    continue;
                }
                $model = new CartProduct();
                $model->product_id = $product->id;
                $model->quantity = $sessionProduct['quantity'];
                $model->price = $product->price;
                $model->discount = $product->old_price - $product->price;
                $model->discount = $model->discount > 0 ? $model->discount : 0;
                $model->total_price = $model->quantity * $model->price;
                $cartProducts[] = $model;
            }
            list($totalDiscount, $totalPrice, $cartQuantity) = $this->caculateCartProducts($cartProducts);
            if(isset($_POST['Cart'])) {
                $post = $_POST['Cart'];
                $cart->name = $post['name'];
                $cart->phone = $post['phone'];
                $cart->address = $post['address'];
                $cart->city = $post['city'];
                $cart->email = $post['email'];
                $cart->description = $post['description'];
                $cart->payment_method = $post['payment_method'];
                $cart->total_price = $totalPrice;
                $cart->total_quantity = $cartQuantity;
                $cart->discount = $totalDiscount;
                $cart->final_money = $totalPrice - $totalDiscount;
                $cart->status = Cart::STATUS_NEW;
                $cart->save();
                if($cart->id != null) {
                    foreach($cartProducts as $cartProduct) {
                        $cartProduct->cart_id = $cart->id;
                        $cartProduct->save();
                    }
                    Yii::$app->session->set('current_cart_products', array());
                    return $this->render('checkout', ['checkoutSuccessful' => true]);
                }
            }
        }
        else {
            $this->goHome();
        }
        return $this->render('checkout', ['model' => $cart]);
    }
}
