<?php
namespace frontend\controllers;

use common\models\SpecialArticle;
use yii\web\Controller;

/**
 * Info controller
 */
class InfoController extends Controller
{
    public function actionContact() {
        $article = SpecialArticle::findOne(1);
        return $this->render('view', [
            'model' => $article,
        ]);
    }
    
    public function actionIntroduce() {
        $article = SpecialArticle::findOne(2);
        return $this->render('view', [
            'model' => $article,
        ]);
    }
}
 