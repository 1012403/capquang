<?php 

use common\components\UrlUtil;
use common\models\ProductCategory;
use yii\web\View;

/* @var $model ProductCategory */
/* @var $this View */

if(isset($model)) {
    $this->title = $model->meta_title;
    $this->registerMetaTag(['name' => 'keyword', 'content' => $model->meta_keyword], 'meta_keyword');
    $this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description], 'meta_desription');
}
else {
    $this->title = 'Tất cả sản phẩm';
}
?>

<div id="sidebar-last-inner-h">
    <div class="home">
        <div class="home-header">
            <h1 class="title"><?= isset($model) ? $model->name : 'Tất cả sản phẩm';?></h1>
            <?php if(isset($model)) : ?>
            <span class="link"><a href="<?= UrlUtil::getViewAllProductsUrl();?>" title="Tất cả sản phẩm">Tất cả sản phẩm</a></span>
            <?php endif;?>
        </div>
        <div class="p-container">
            <ul>
                <?php foreach ($products as $product) : ?>
                    <li class="items ">
                        <a href="<?= UrlUtil::getViewProductDetailsUrl($product); ?>" title="<?= $product->name ?>">
                            <img class="img" alt="<?= $product->name ?>"
                                 src="<?= $product->image ?>"><br>
                            <b><?= $product->name ?></b>
                        </a>
                                        <span class="price"><?= Yii::$app->formatter->asDecimal($product->price) ?>
                                            VND</span>
                        <button
                            url="<?= Yii::$app->urlManager->createUrl(['/ajax-cart/add-to-cart', 'product_id' => $product->id]) ?>"
                            class="btn-buy">MUA HÀNG
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
</div>