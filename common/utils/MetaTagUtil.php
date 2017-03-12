<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MetaTagUtil
 *
 * @author Shao1
 */
namespace common\utils;

class MetaTagUtil {
    public static function registerTagBySetting($view, $setting)
    {
        if(isset($setting->meta_tag_title) && !empty($setting->meta_tag_title))
        {
            $view->title= $setting->meta_tag_title . " - " . \Yii::$app->name;
        }
        if(isset($setting->meta_tag_keywords) && !empty($setting->meta_tag_keywords))
        {
            $view->registerMetaTag(['name'=> 'keywords', 'content' => $setting->meta_tag_keywords]);
        }
        if(isset($setting->meta_tag_description) && !empty($setting->meta_tag_description))
        {
            $view->registerMetaTag(['name'=> 'description', 'content' => $setting->meta_tag_description]);
        }
    }
    
    public static function registerTagByModel($view, $model)
    {
        if(isset($model->meta_title) && !empty($model->meta_title))
        {
            $view->title= $model->meta_title . " - " . \Yii::$app->name;
			
        } else {
			if (isset($model->title)) {
				$view->title= $model->title . " - " . \Yii::$app->name;
			}
		}
        if(isset($model->meta_keyword) && !empty($model->meta_keyword))
        {
            $view->registerMetaTag(['name'=> 'keywords', 'content' =>  $model->meta_keyword]);
        }
        if(isset($model->meta_description) && !empty($model->meta_description))
        {
            $view->registerMetaTag(['name'=> 'description', 'content' => $model->meta_description]);
        }
    }
}
