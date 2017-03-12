<?php

use backend\assets\AppAsset;
use kartik\nav\NavX;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use \common\utils\RightUtils;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/admin/favicon.ico" type="image/x-icon" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php

            use kartik\widgets\AlertBlock;

echo AlertBlock::widget([
                'type' => AlertBlock::TYPE_GROWL,
                'useSessionFlash' => true,
                'delay' => false
            ]);
            ?>
            <?php
            NavBar::begin([
                'brandLabel' => Html::img(Yii::getAlias('@web')."/images/logo.png"),
                'brandUrl' => Yii::$app->getRequest()->getHostInfo(),
                'options' => [
                    'class' => 'admin-navbar navbar-fixed-top',
                ],
            ]);
            $menuItems = [];
            if (!Yii::$app->user->isGuest) {
                $menuItems = [
                    [
                        'label' => 'Dashboard', 'url' => ['/']
                    ],
                    ['label' => 'Tin Tức', 'url' => ['/news']],
                    ['label' => 'Danh mục tin tức', 'url' => ['/news-category']],
                    ['label' => 'Menu',  'url' => ['/menu']],
                    ['label' => 'Websetting', 'url' => ['/setting']],
                ];
            }

            $rightMenuItems = array();
            if (Yii::$app->user->isGuest) {
                $rightMenuItems[] = ['label' => 'Đăng nhập', 'url' => ['/site/login']];
            } else {
                $rightMenuItems[] = [
                    'label' => Yii::$app->user->identity->username,
                    'items' => [
                        ['label' => 'Đổi thông tin', 'url' => ['/site/edit-profile']],
                        ['label' => 'Thoát', 'url' => ['/site/logout'], 
                                'linkOptions' => ['data-method' => 'post']]
                    ]
                ];
            }
            echo NavX::widget([
                'options' => ['class' => 'navbar-nav'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $rightMenuItems,
            ]);

            NavBar::end();
            ?>

            <div class="bs-docs-header" tabindex="-1">
                <div class="container">
                    <h1><?= $this->title ?></h1>
                    <p><?= isset($this->params['description']) ? $this->params['description'] : "" ?></p>
                </div>
            </div>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
