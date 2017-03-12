<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<!DOCTYPE html>
<?php $this->beginPage() ?>
<html class="no-js">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/img/favicon.html">
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body class="login-page">
        <?php $this->beginBody() ?>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

                <!-- BEGIN Main Content -->
                
                <?php echo $content?>
                
                <!-- END Main Content -->

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>