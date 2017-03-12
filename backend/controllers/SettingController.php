<?php

namespace backend\controllers;

use Yii;
use common\models\Setting;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\components\BaseController;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends BaseController
{
    public function actionIndex() {
        if (($model = Setting::find()->one()) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        $post = Yii::$app->request->post();

        // return messages on update of record
        if ($model->load($post)) {
            if ($model->save()) {
                // Save success
                Yii::$app->session->setFlash('kv-detail-success', 'Lưu thành công');
            } else {
                var_dump($model->getErrors()); die;
                // Save fail
                Yii::$app->session->setFlash('kv-detail-error', 'Lưu KHÔNG thành công. Vui lòng liên hệ quản trị viên để biết thêm chi tiết');
            }
        }
        return $this->render('update', [
            'model' => $model
        ]);
    }
}
