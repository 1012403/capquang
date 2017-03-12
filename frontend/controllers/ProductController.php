<?php
namespace frontend\controllers;

use common\models\Product;
use common\models\ProductCategory;
use yii\web\Controller;

/**
 * Product controller
 */
class ProductController extends Controller
{
    public function actionIndex() {
        $products = Product::find()->all();
        return $this->render('index', ['products' => $products]);
    }
    
    /*
     * View all Products in Category
     */
    public function actionViewCategory($cat_alias) {
        $cat_alias = preg_replace('/\/$/', '', $cat_alias);
        $productCategory = ProductCategory::findOne(['alias' => $cat_alias]);
        if($productCategory == null) {
            $this->goHome();
        }
        $products = Product::findAll([
            'product_category_id' => $productCategory->id
        ]);
        return $this->render('index', [
            'model' => $productCategory,
            'products' => $products
        ]);
    }
    
    /**
     * View Details Product
     */
    public function actionView($p_alias) {
        $product = Product::findOne(['alias' => $p_alias]);
        if(!$product) {
            $this->goHome();
        }
        return $this->render('details', [
            'model' => $product
        ]);
    }
}
 