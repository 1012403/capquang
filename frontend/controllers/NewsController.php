<?php
namespace frontend\controllers;

use common\models\News;
use yii\web\Controller;

/**
 * News controller
 */
class NewsController extends Controller
{
    /*
     * View all Newss
     */
    public function actionView($alias) {
        $news = News::findOne(['alias' => $alias]);
        if(!$news) {
            $this->goHome();
        }
        return $this->render('view', [
            'model' => $news,
        ]);
    }
}
 