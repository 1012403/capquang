<?php

use common\models\Setting;
use kartik\detail\DetailView;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Setting */

$this->title = 'Chỉnh sửa Web Setting';
$this->params['description'] = 'Web Setting';
$this->params['breadcrumbs'][] = ['label' => 'Web Setting'];
?>
<div class="web-setting-update">

    <?php
    // Attributes
    $attributes = [
        [
            'attribute' => 'default_news',
            'format' => 'raw',
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => CKEditor::className(),
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder')
            ]
        ],
        [
            'group' => true,
            'label' => 'Meta Tag',
            'rowOptions' => ['class' => 'info'],
        ],
        [
            'attribute' => 'meta_tag_title',
        ],
        [
            'attribute' => 'meta_tag_keywords',
        ],
        [
            'attribute' => 'meta_tag_description',
            'format' => 'raw',
            'type' => DetailView::INPUT_TEXTAREA
        ],
        [
            'group' => true,
            'label' => '    Link Liên kết',
            'rowOptions' => ['class' => 'info'],
        ],
        [
            'attribute' => 'facebookLink',
            'format' => 'raw',
            'value' => $model->facebookLink
        ],
    ];

    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
        'mode' => 'edit',
        'hover' => true,
        'container' => ['id' => 'kv-news'],
        'formOptions' => [
            'options' => ['enctype' => 'multipart/form-data'],
        ],
        'panel' => [
            'heading' => '<i class="glyphicon glyphicon-book"></i> ' . $this->title,
            'type' => DetailView::TYPE_PRIMARY,
        ],
        'buttons2' => '{reset} {save}',
        'buttons1' => "{update}"
    ]);
    ?>



</div>
