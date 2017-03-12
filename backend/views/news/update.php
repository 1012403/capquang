<?php

use common\models\category\NewsCategory;
use common\models\News;
use kartik\detail\DetailView;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model News */

$this->title = $model->isNewRecord ? "Tạo mới Tin Tức" : 'Chỉnh sửa ' . ' ' . $model->title;
$this->params['description'] = 'Điền các thông tin bên dưới để tạo mới hoặc cập nhật Tin Tức';
$this->params['breadcrumbs'][] = ['label' => 'Tin Tức', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-update">

    <?php
    // Attributes
    $attributes = [
        [
            'group' => true,
            'label' => 'SECTION 1: Thông Tin Chung',
            'rowOptions' => ['class' => 'info'],
        ],
        'title',
        'tag',
       [
           'attribute' => 'news_category_id',
           'value' => $model->newsCategory ? $model->newsCategory->name : '',
           'format' => 'raw',
           'type' => DetailView::INPUT_DROPDOWN_LIST,
           'items' => common\models\NewsCategory::getArrayNewsCategory(),
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
            'label' => 'SECTION 2: Nội Dung',
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
            'type' => DetailView::INPUT_TEXTAREA
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
        'container' => ['id' => 'kv-news'],
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
