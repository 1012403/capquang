<?php

use common\components\UrlUtil;
use common\models\SpecialArticle;

/* @var $model SpecialArticle */

$this->title= $model->meta_title;
$this->registerMetaTag(['name'=>'description', 'content' => $model->meta_description], 'meta_description');
$this->registerMetaTag(['name'=>'keywords', 'content' => $model->meta_keyword], 'meta_keywords');

?>
<ul class="category-name">
    <li>
        <a href="/">Trang chủ</a>
    </li>
    <li>
        <?= $model->name; ?>
    </li>
</ul>
<div class="news-container">
    <div class="news-content">
        <?= $model->content; ?>
    </div>
</div>