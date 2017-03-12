<?php

namespace backend\controllers;

use backend\components\BackendController;
use common\models\Product;
use common\models\ProductSearch;
use yii\web\NotFoundHttpException;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BackendController {

    protected function getNewModel() {
        return new Product();
    }
    
    protected function getSearchModel() {
        return new ProductSearch();
    }

    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
