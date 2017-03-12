<?php

namespace backend\controllers;

use common\components\BaseController;
use common\models\Slider;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use kartik\detail\DetailView;


/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends BaseController {

    public function actionIndex() {
        $model = Slider::find()->one();
        $mode = DetailView::MODE_VIEW;
        
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
}
