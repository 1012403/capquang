<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use common\models\Product;
use common\models\ProductCategory;
use Yii;

/**
 * Description of UrlUtil
 *
 * @author Shao
 */
class UrlUtil {

    // Frontend
    
    /**
     * @param ProductCategory $productCategory
     */
    public static function getViewProductCategoryUrl($productCategory) {
        return Yii::$app->urlManager->createUrl('/c/'.$productCategory->alias.'/');
    }
    
    public static function getViewAllProductsUrl() {
        return Yii::$app->urlManager->createUrl('/tat-ca-san-pham.html');
    }
    
    /**
     * @param Product $product
     */
    public static function getViewProductDetailsUrl($product) {
        return Yii::$app->urlManager->createUrl('/p/'.$product->alias.'.html');
    }
    
    /**
     * @param Product $product
     */
    public static function getBuyProductUrl($product) {
        return Yii::$app->urlManager->createUrl(['/ajax-cart/add-to-cart', 'product_id' => $product->id]);
    }
    
    public static function getCheckoutUrl() {
        return Yii::$app->urlManager->createUrl('/checkout.html');
    }
    
    /**
     * @param \common\models\News $news
     */
    public static function getViewNewsUrl($news) {
        return Yii::$app->urlManager->createUrl('/n/'.$news->alias.'.html');
    }
}
