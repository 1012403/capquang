<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
?>
<link href="<?php echo Yii::getAlias('@web'); ?>/css/login/flaty.css" rel="stylesheet">
<link href="<?php echo Yii::getAlias('@web'); ?>/css/login/normalize.css" rel="stylesheet">
<div class="login-wrapper">
    <!-- BEGIN Login Form -->
    <?php
    $form = ActiveForm::begin([
                'options' => ['id' => 'form-login'],
                'errorCssClass' => 'error',
                'fieldConfig' => ['template' => '{label}<div class="controls">{input}{error}{hint}</div>',
                    'options' => ['class' => 'control-group'],
                    'inputOptions' => ['class' => 'input-block-level'],
//                                                    'errorOptions' => ['class' => 'help-block'],
                    'validateOnChange' => true,
                ],
    ]);
    ?>
    <h3>Welcome to Admin</h3>
    <hr/>
<?= $form->field($model, 'username')->textInput(['style' => 'width:100%;']) ?>
<?= $form->field($model, 'password')->passwordInput(['style' => 'width:100%;']) ?>
<?= $form->field($model, 'rememberMe')->checkbox() ?>
    <div class="control-group">
        <div class="controls">
            <button style="width: 100%;" type="submit" class="btn btn-primary input-block-level">Sign In</button>
        </div>
    </div>
    <hr/>
<!--    <p class="clearfix">
        <a href="#" class="goto-forgot pull-left">Forgot Password?</a>
    </p>-->
<?php ActiveForm::end(); ?>
    <!-- END Login Form -->
</div>
<!-- END Main Content -->

