<?php

use common\models\Article;
use mihaildev\elfinder\InputFile;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Article $model
 * @var int $type  cartegoryType
 */
$this->title = 'Edit Profile';
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <form class="form-horizontal" method="post">
                <div class="box-body">
                    <h4 class="box-title">Change Profile</h4>
                    <?php 
                    $form = new ActiveForm([
                        'fieldConfig'=> [
                            'template'=> '{label}<div class="col-sm-10">{input}{error}{hint}</div>',
                            'labelOptions' => ['class' => 'col-sm-2 control-label']
                        ],
                    ]);
                    ?>
                    <?php echo $form->field($model, 'email')->textInput(['placeholder' => 'Email']) ?>
                    <h4>Password</h4>
                    <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>
                    <?php echo $form->field($model, 'new_password')->passwordInput(['placeholder' => 'New Password']) ?>
                    <?php echo $form->field($model, 'new_password_repeat')->passwordInput(['placeholder' => 'Repeat Password']) ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>

