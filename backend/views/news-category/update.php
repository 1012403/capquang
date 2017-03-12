<?php

use common\models\NewsCategory;
use kartik\detail\DetailView;
use yii\web\View;

/* @var $this View */
/* @var $model common\models\NewsCategoryCategory */

$this->title = ($model->isNewRecord ? 'Tạo mới' : 'Chỉnh sửa'). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Danh mục Sản Phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-update">

    
    <?php
    // Attributes
    $attributes = [
        [
            'group' => true,
            'label' => 'SECTION 1: Thông Tin Chung',
            'rowOptions' => ['class' => 'info'],
        ],
        'name',
        // [
        //     'attribute' => 'parent_category_id',
        //     'value' => $model->parentCategory ? $model->parentCategory->name : '',
        //     'format' => 'raw',
        //     'type' => DetailView::INPUT_DROPDOWN_LIST,
        //     'options' => [
        //         'prompt' => 'Chọn Danh mục cha'
        //     ],
        //     'items' => NewsCategory::getArrayParentNewsCategory($model->id),
        // ],
        [
            'attribute' => 'sort',
            'type' => DetailView::INPUT_TEXT,
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
        [
            'group' => true,
            'label' => 'SECTION 3: SEO',
            'rowOptions' => ['class' => 'info'],
        ],
        'alias',
        'meta_title',
        'meta_keyword',
        [
            'attribute' => 'meta_description',
            'format' => 'raw',
            'type' => DetailView::INPUT_TEXTAREA
        ]
    ];

    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
        'mode' => $mode,
        'hover' => true,
        'deleteOptions' => [// your ajax delete parameters
            'params' => ['kvdelete' => true],
        ],
        'container' => ['id' => 'kv-news'],
        'formOptions' => [
            'options' => ['enctype' => 'multipart/form-data'],
        ],
        'panel' => [
            'heading' => '<i class="glyphicon glyphicon-book"></i> ' . $this->title,
            'type' => DetailView::TYPE_PRIMARY,
        ],
        'buttons2' => $model->isNewRecord ? '{reset} {save}' : '{view} {reset} {save}',
        'buttons1' => "{update}{delete}",
    ]);
?>
</div>
