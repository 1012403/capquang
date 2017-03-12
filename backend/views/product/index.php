<?php

use common\models\NewsSearch;
use common\models\ProductCategory;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\View;

/* @var $this View */
/* @var $searchModel NewsSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Quản lý Sản Phẩm';
$this->params['breadcrumbs'][] = $this->title;
$this->params['description'] = 'Trang giúp quản lý tất cả Sản Phẩm';
?>
<div class="product-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'width' => '36px',
                'header' => '',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'name',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a($model->name, ['/product/view', 'id' => $model->id]);
                },
                'format' => 'raw',
//                'headerOptions' => ['style' => "padding-right: 200px;"]
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'price',
                'width' => '70px',
                'format' => 'decimal',
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'width' => '150px',
                'attribute' => 'alias'
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'width' => '300px',
                'attribute' => 'meta_title'
            ],
            [
                'attribute' => 'product_category_id',
                'vAlign' => 'middle',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
            return HtmlPurifier::process($model->productCategory ? $model->productCategory->name : null);
        },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ProductCategory::getArrayProductCategory(),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Danh mục Sản Phẩm'],
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update}{delete}',
                'dropdownOptions' => ['class' => 'pull-right'],
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
        ],
        'toolbar' => [
            [
                'content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/product/create'], ['type' => 'button', 'title' => 'Tạo mới', 'class' => 'btn btn-success'])
                . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/product'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Làm mới'])
            ],
            '{export}'
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        // parameters from the demo form
        'bordered' => true,
        'striped' => false,
        'condensed' => true,
        'responsive' => false,
        'hover' => true,
//        'showPageSummary'=>true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode($this->title),
        ],
        'persistResize' => false,
    ]);
    ?>

</div>
