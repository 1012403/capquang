<?php

use common\models\NewsCategory;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\View;

/* @var $this View */
/* @var $searchModel common\models\category\CategorySearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Quản lý Danh mục Sản Phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class'=>'kartik\grid\SerialColumn',
                'contentOptions'=>['class'=>'kartik-sheet-style'],
                'width'=>'36px',
                'header'=>'',
                'headerOptions'=>['class'=>'kartik-sheet-style']
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'name',
                'format' => 'raw',
                'width' => '150px',
//                'value' => function ($model)
//                {
//                    return Html::a($model->name, ['view', 'id' => $model->id]);
//                }
            ],
            // [
            //     'attribute' => 'parent_category_id',
            //     'vAlign' => 'middle',
            //     'width' => '150px',
            //     'value' => function ($model, $key, $index, $widget) {
            //         return HtmlPurifier::process($model->parentCategory ? $model->parentCategory->name : null);
            //     },
            //     'filterType' => GridView::FILTER_SELECT2,
            //     'filter' => NewsCategory::getArrayNewsCategory(),
            //     'filterWidgetOptions' => [
            //         'pluginOptions' => ['allowClear' => true],
            //     ],
            //     'filterInputOptions' => ['placeholder' => 'Danh mục Sản Phẩm'],
            //     'format' => 'raw'
            // ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'alias'
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'width' => '300px',
                'attribute' => 'meta_keyword'
            ],
            'sort',
            [
                'class'=>'kartik\grid\ActionColumn',
                'template' => '{moveup}{movedown}{update}{delete}',
                'dropdownOptions'=>['class'=>'pull-right'],
                'headerOptions'=>['class'=>'kartik-sheet-style'],
                'width' => '150px',
                'buttons' => [
                    'moveup' => function ($url, $model) {
                        $icon = '<span class="glyphicon glyphicon-arrow-up"></span>';
                        $options = ['title' => "Di chuyển lên", 'data-pjax' => '0'];
                        return Html::a($icon, $url, $options);
                    },
                    'movedown' => function ($url, $model) {
                        $icon = '<span class="glyphicon glyphicon-arrow-down"></span>';
                        $options = ['title' => "Di chuyển xuống", 'data-pjax' => '0'];
                        return Html::a($icon, $url, $options);
                    }
                ]
            ],
            [
                'class'=>'kartik\grid\CheckboxColumn',
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],
        ],
        'toolbar'=> [
            [
                'content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/news-category/create'], ['type'=>'button', 'title'=> 'Tạo mới', 'class'=>'btn btn-success']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/news-category'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Làm mới'])
            ],
            '{export}'
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        // parameters from the demo form
        'bordered'=> true,
        'striped'=>false,
        'condensed'=>true,
        'responsive'=>false,
        'hover'=>true,
//        'showPageSummary'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=>'<i class="glyphicon glyphicon-book"></i> ' . Html::encode($this->title) ,
        ],
        'persistResize'=>false,
    ]); ?>

</div>
