<?php

namespace backend\controllers;

use backend\components\BackendController;
use common\models\SpecialArticle;
use common\models\SpecialArticleSearch;
use yii\web\NotFoundHttpException;


/**
 * SpecialArticleController implements the CRUD actions for SpecialArticle model.
 */
class SpecialArticleController extends BackendController {

    protected function getNewModel() {
        return new SpecialArticle();
    }
    
    protected function getSearchModel() {
        return new SpecialArticleSearch();
    }

    protected function findModel($id) {
        if (($model = SpecialArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
