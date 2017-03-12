<?php

use common\models\category\ProductCategory;
use common\models\Product;
use kartik\detail\DetailView;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Product */

$this->title = $model->isNewRecord ? "Tạo mới Sản Phẩm" : 'Chỉnh sửa ' . ' ' . $model->name;
$this->params['description'] = 'Điền các thông tin bên dưới để tạo mới hoặc cập nhật Sản Phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Sản Phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-update">

    <?php
    // Attributes
    $attributes = [
        [
            'group' => true,
            'label' => 'SECTION 1: Thông Tin Sản Phẩm',
            'rowOptions' => ['class' => 'info'],
        ],
        'name',
        [
            'attribute' => 'product_category_id',
            'value' => $model->productCategory ? $model->productCategory->name : '',
            'format' => 'raw',
            'type' => DetailView::INPUT_DROPDOWN_LIST,
            'items' => common\models\ProductCategory::getArrayProductCategory(),
        ],
//        [
//            'attribute' => 'old_price',
//            'format' => 'decimal',
//            'type' => DetailView::INPUT_MONEY,
//        ],
        [
            'attribute' => 'price',
            'format' => 'decimal',
            'type' => DetailView::INPUT_MONEY,
        ],
        [
            'group' => true,
            'label' => 'SECTION 2: Giới thiệu',
            'rowOptions' => ['class' => 'info'],
        ],
        [
            'attribute' => 'image',
            'format' => 'raw',
            'value' => Html::img($model->image, ['width' => 120, 'height' => 120]),
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => \mihaildev\elfinder\InputFile::className(),
                'filter'           => 'image'
            ]
        ],
        [
            'attribute' => 'short_content',
            'format' => 'raw',
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => CKEditor::className(),
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder')
            ]
        ],
        [
            'attribute' => 'content',
            'format' => 'raw',
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => CKEditor::className(),
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder')
            ]
        ],
        [
            'group' => true,
            'label' => 'SECTION 3: Thông tin SEO',
            'rowOptions' => ['class' => 'info'],
        ],
        'meta_keyword',
        'alias',
        'meta_title',
        [
            'attribute' => 'meta_description',
            'type' => DetailView::INPUT_TEXTAREA,
        ],
        [
            'attribute' => 'created_by',
            'format' => 'raw',
            'value' => $model->createdBy,
            'rowOptions' => ['class' => 'kv-edit-hidden']
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'rowOptions' => ['class' => 'kv-edit-hidden']
        ],
        [
            'attribute' => 'updated_by',
            'format' => 'raw',
            'value' => $model->updatedBy,
            'rowOptions' => ['class' => 'kv-edit-hidden']
        ],
        [
            'attribute' => 'updated_at',
            'format' => 'datetime',
            'rowOptions' => ['class' => 'kv-edit-hidden']
        ],
    ];

    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
        'mode' => $mode,
        'hover' => true,
        'deleteOptions' => [// your ajax delete parameters
            'params' => ['kvdelete' => true],
        ],
        'container' => ['id' => 'kv-product'],
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
