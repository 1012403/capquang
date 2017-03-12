<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CController
 *
 * @author Shao
 */
namespace backend\components;

use common\components\BaseController;
use kartik\detail\DetailView;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\StringHelper;

abstract class BackendController extends BaseController{
    
    abstract protected function getSearchModel();
    abstract protected function getNewModel();
    abstract protected function findModel($id);

    /**
     * Lists all models.
     * @return mixed
     */
    public function actionIndex() {
        $this->editableAttribute();
        $searchModel = $this->getSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->resolveDataProviderForIndexAction($dataProvider);
        
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    protected function editableAttribute() {
        $post = Yii::$app->request->post();
        if(isset($post['hasEditable'])) {
            $modelClassName = get_class($this->getNewModel());
            $class = StringHelper::basename($modelClassName);
            /* @var $model ActiveRecord */
            $model = $modelClassName::findOne($post['editableKey']);
            $attribute = $post['editableAttribute'];
            $oldValue = $model->{$attribute};
            $newValue = $post[$class][$post['editableIndex']][$attribute];
            $model->{$attribute} = $newValue;
            if($model->validate([$attribute])) {
                echo json_encode(['message' => '', 'output' => $newValue]); 
                $model->save(false); die();
            }
            else {
                echo json_encode(['message' => $model->getErrors(), 'output' => $oldValue]); die();
            }
        }
    }
    
    /**
     * 
     * @param ActiveDataProvider $dataProvider
     */
    protected function resolveDataProviderForIndexAction($dataProvider) {
        $defaultSort = $this->getDefaultSort();
        if($defaultSort) {
            $dataProvider->query->orderBy($defaultSort);
        }
    }
    
    /**
     * @return string|array 'attribute ASC' or ['attribute' => SORT_ASC]
     */
    protected function getDefaultSort() {
        return 'id DESC';
    }


/**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = $this->getNewModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'mode' => DetailView::MODE_EDIT
            ]);
        }
    }
    
    
    public function actionUpdate($id)
    {
        return $this->processUpdate($id);
    }
    
    
    /**
     * Displays a single DocumentIn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->processUpdate($id, DetailView::MODE_VIEW);
    }

    /**
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function processUpdate($id, $mode = DetailView::MODE_EDIT) {
        $model = $this->findModel($id);
        
        $post = Yii::$app->request->post();

        // process ajax delete
        if (Yii::$app->request->isAjax && isset($post['kvdelete'])) {
            if ($model->delete()) {
                // Delete success
                echo Json::encode([
                    'success' => true,
                    'messages' => [
                        'kv-detail-info' => "Xóa thành công " .
                        Html::a('<i class="glyphicon glyphicon-hand-right"></i>  Bấm vào đây', ['index'], ['class' => 'btn btn-sm btn-info']) . ' để về trang danh sách.'
                    ]
                ]);
                return;
            } else {
                // Delete fail
                echo Json::encode([
                    'success' => false,
                    'messages' => [
                        'kv-detail-error' => "Xóa không thành công "
                    ]
                ]);
                return;
            }
        }

        // return messages on update of record
        if ($model->load($post)) {
            if ($model->save()) {
                // Save success
                $mode = DetailView::MODE_VIEW;
                Yii::$app->session->setFlash('kv-detail-success', 'Lưu thành công');
            } else {
                // Save fail
                Yii::$app->session->setFlash('kv-detail-error', 'Lưu KHÔNG thành công. Vui lòng liên hệ quản trị viên để biết thêm chi tiết');
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'mode' => $mode
        ]);
    }

    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }
}
