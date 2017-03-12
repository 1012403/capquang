<?php

use common\components\UrlUtil;
use common\models\Product;

/* @var $model Product */
$this->title= $model->meta_title;
$this->registerMetaTag(['name'=>'description', 'content' => $model->meta_description], 'meta_description');
$this->registerMetaTag(['name'=>'keywords', 'content' => $model->meta_keyword], 'meta_keywords');

?>
<ul class="category-name">
    <li>
        <a href="/">Trang chủ</a>
    </li>
    <?php 
        $pcs = [];
        $pc = $model->productCategory;
        while($pc) {
            $pcs[] = $pc;
            $pc = $pc->parentCategory;
        }
        for($i = count($pcs); $i > 0; $i--) :
        $item = $pcs[$i - 1];    
    ?>
        <li>
            <a href="<?php UrlUtil::getViewProductCategoryUrl($item)?>"><?= $item->name; ?></a>
        </li>
    <?php 
        endfor;
    ?>
    <li>
        <?= $model->name; ?>
    </li>
</ul>
<div class="product-item">
    <div class="product-item-detail">
        <img src="<?= $model->image; ?>" width="430" height="300" />
        <div class="detail-product">
            <h4><?= $model->name;?></h4>
            <?= $model->short_content;?>
            <p class="hr">
                <b>Giá:</b><span class="price"> <?= Yii::$app->formatter->asDecimal($model->price);?> VND</span>

            </p>

            <button url="<?= UrlUtil::getBuyProductUrl($model); ?>" class="btn-buy">MUA HÀNG</button>
        </div>
    </div>
</div>
<div class="product-info">
    <ul class="tab-info">
        <li class="active">
            Tổng quan
        </li>
    </ul>
    <div class="content-info">
        <?= $model->content;?>
    </div>
</div>