<?php

namespace backend\controllers;

use backend\components\BackendController;
use common\models\News;
use common\models\NewsSearch;
use yii\web\NotFoundHttpException;


/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends BackendController {

    protected function getNewModel() {
        return new News();
    }
    
    protected function getSearchModel() {
        return new NewsSearch();
    }

    protected function findModel($id) {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
