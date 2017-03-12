<?php

use common\models\Menu;
use common\models\MenuSearch;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\View;

/* @var $this View */
/* @var $searchModel MenuSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Quản lý Menu Top';
$this->params['breadcrumbs'][] = $this->title;
$this->params['description'] = 'Trang giúp quản lý Menu Top';
?>
<div class="menu-index">
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
                'attribute' => 'title',
                'value' => function ($model, $key, $index, $widget) {
            return Html::a($model->title, ['/menu/view', 'id' => $model->id]);
        },
                'format' => 'raw',
                'width' => '250px',
//                'headerOptions' => ['style' => "padding-right: 200px;"]
            ],
            [
                'attribute' => 'parent_id',
                'vAlign' => 'middle',
                'width' => '250px',
                'value' => function ($model, $key, $index, $widget) {
            return HtmlPurifier::process($model->parent ? $model->parent->title : null);
        },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => Menu::getArrayCategory(),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Menu Cha'],
                'format' => 'raw'
            ],
            [
                'attribute' => 'url',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a($model->url, $model->url);
                },
                'format' => 'raw',
//                'headerOptions' => ['style' => "padding-right: 200px;"]
            ],
            'sort',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{moveup}{movedown}{update}{delete}',
                'dropdownOptions' => ['class' => 'pull-right'],
                'headerOptions' => ['class' => 'kartik-sheet-style'],
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
                'class' => 'kartik\grid\CheckboxColumn',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
        ],
        'toolbar' => [
            [
                'content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/menu/create'], ['type' => 'button', 'title' => 'Tạo mới', 'class' => 'btn btn-success'])
                . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/menu'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Làm mới'])
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
