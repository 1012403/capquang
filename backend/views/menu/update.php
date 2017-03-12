<?php

use common\models\Menu;
use kartik\detail\DetailView;
use yii\web\View;

/* @var $this View */
/* @var $model Menu */

$this->title = $model->isNewRecord ? "Tạo mới Menu Top" : 'Chỉnh sửa ' . ' ' . $model->title;
$this->params['description'] = 'Điền các thông tin bên dưới để tạo mới hoặc cập nhật Menu Top';
$this->params['breadcrumbs'][] = ['label' => 'Menu Top', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-update">

    <?php
    // Attributes
    $attributes = [
        'title',
        [
            'attribute' => 'parent_id',
            'value' => $model->parent ? $model->parent->title : '',
            'format' => 'raw',
            'type' => DetailView::INPUT_DROPDOWN_LIST,
            'items' => Menu::getArrayParentMenu($model->id),
            'options' => [
                'prompt' => 'Chọn Menu cha'
            ],
        ],
        'url',
        'sort'
    ];

    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
        'mode' => $mode,
        'hover' => true,
        'deleteOptions' => [// your ajax delete parameters
            'params' => ['kvdelete' => true],
        ],
        'container' => ['id' => 'kv-menu'],
        'formOptions' => [
            'options' => ['enctype' => 'multipart/form-data'],
        ],
        'panel' => [
            'heading' => '<i class="glyphicon glyphicon-book"></i> ' . $this->title,
            'type' => DetailView::TYPE_PRIMARY,
        ],
        'buttons2' => $model->isNewRecord ? '{reset} {save}' : '{view} {reset} {save}',
        'buttons1' => "{update}{delete}"
    ]);
    ?>



</div>
