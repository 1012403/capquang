<?php

use common\utils\StringsUtil;
use common\models\NewsSearch;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\View;

/* @var $this View */
/* @var $searchModel NewsSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Quản lý tin tức';
$this->params['breadcrumbs'][] = $this->title;
$this->params['description'] = 'Trang giúp quản lý tất cả tin tức';
?>
<div class="news-index">
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
                'attribute' => 'title',
                'width' => '250px',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a($model->title, ['/news/view', 'id' => $model->id]);
                },
                'format' => 'raw',
                'headerOptions' => ['style' => "padding-right: 200px;"]
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'width' => '300px',
                'attribute' => 'tag'
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
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/news/create'], ['type' => 'button', 'title' => 'Tạo mới', 'class' => 'btn btn-success'])
                . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/news'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Làm mới'])
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
