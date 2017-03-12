<?php

namespace backend\controllers;

use backend\components\BackendController;
use common\models\Menu;
use common\models\MenuSearch;
use Yii;
use yii\web\NotFoundHttpException;


/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends BackendController {

    public function actionIndex() {
        $searchModel = $this->getSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('sort ASC');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function getNewModel() {
        $menu = new Menu();
        $menu->sort = 0;
        return $menu;
    }
    
    protected function getSearchModel() {
        return new MenuSearch();
    }

    protected function findModel($id) {
        if (($model = Menu::findOne($id)) !== null) {
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
        $menu = Menu::findOne($id);
        if (!$menu) {
            return true;
        }
        $menues = Menu::find()->where(['parent_id' => $menu->parent_id])->orderBy('sort ASC')->all();
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
