<?php

use common\components\UrlUtil;
use common\models\News;

/* @var $model News */
$this->title= $model->meta_title;
$this->registerMetaTag(['name'=>'description', 'content' => $model->meta_description], 'meta_description');
$this->registerMetaTag(['name'=>'keywords', 'content' => $model->meta_keyword], 'meta_keywords');

?>
<ul class="category-name">
    <li>
        <a href="/">Trang chủ</a>
    </li>
    <li>
        <?= $model->title; ?>
    </li>
</ul>
<div class="news-container">
    <div class="news-datecreate">
        Ngày đăng tin: <?= Yii::$app->formatter->asDate($model->updated_at);?>
    </div>
    <div class="news-content">
        <?= $model->content; ?>
    </div>
</div>
<div id="other-news" class="other-news">
    <div class="title">
        Tin liên quan <div style="float: right; padding-right: 10px">
        </div>
    </div>
    <?php $relate_news = $model->getRalateNews();?>
    <ul>
        <?php foreach($relate_news as $item) :?>
            <li><a href="<?= UrlUtil::getViewNewsUrl($item) ?>"><?= $item->title; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>