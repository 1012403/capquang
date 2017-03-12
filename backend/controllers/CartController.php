<?php

namespace backend\controllers;

use backend\components\BackendController;
use common\models\Cart;
use common\models\CartSearch;
use yii\web\NotFoundHttpException;


/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends BackendController {

    protected function getNewModel() {
        $cart = new Cart();
        $cart->status = Cart::STATUS_NEW;
        return $cart;
    }
    
    protected function getSearchModel() {
        return new CartSearch();
    }

    protected function findModel($id) {
        if (($model = Cart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
