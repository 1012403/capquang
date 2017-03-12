<?php

namespace backend\controllers;

use backend\components\BackendController;
use common\models\NewsCategory;
use common\models\NewsCategorySearch;
use Yii;
use yii\web\NotFoundHttpException;


/**
 * NewsCategoryController implements the CRUD actions for NewsCategory model.
 */
class NewsCategoryController extends BackendController {

    protected function getDefaultSort() {
        return 'sort ASC';
    }

    protected function getNewModel() {
        $NewsCategory = new NewsCategory();
        $NewsCategory->sort = 0;
        return $NewsCategory;
    }
    
    protected function getSearchModel() {
        return new NewsCategorySearch();
    }

    protected function findModel($id) {
        if (($model = NewsCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionMoveup($id) {
        return $this->move($id, 'up');
    }

    public function actionMovedown($id) {
        return $this->move($id, 'down');
    }

    protected function move($id, $type) {
        $menu = NewsCategory::findOne($id);
        if (!$menu) {
            return true;
        }
        $menues = NewsCategory::find()->where(['parent_category_id' => $menu->parent_category_id])->orderBy('sort ASC')->all();
        foreach ($menues as $key => $item) {
            if ($item->sort != $key) {
                $item->sort = $key;
                $item->save(false);
            }
        }

        foreach ($menues as $key => $item) {
            if ($item->id == $id && $key > 0) {
                if($type == 'down') {
                    $newKey = $key + 1;
                }
                else {
                    $newKey = $key - 1;
                }
                $item->sort = $newKey;
                $item->save(false);
                if (isset($menues[$newKey])) {
                    $menues[$newKey]->sort = $key;
                    $menues[$newKey]->save(false);
                }
                break;
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
