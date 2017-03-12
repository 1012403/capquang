<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagesUtils
 *
 * @author Shao
 */
namespace common\utils;

use Yii;

class ImagesUtil {
    
    public static function getImageFile($fileName)
    {
        return !empty($fileName) ? Yii::getAlias('@uploadPath') . '/images/' . $fileName : null ;
    }
    
    public static function getImageUrl($fileName)
    {
        $image = 'notfound.jpg';
        if(!empty($fileName))
        {
            if(file_exists(static::getImageFile($fileName)))
            {
                $image= $fileName;
            }
        }
//        return Yii::$app->params['uploadUrl'] .'/'. $image;
        return Yii::$app->urlManager->createUrl(['image/get-image', 'file'=> $image]);
    }
    
    public static function getAbosoluteUrl($fileName) {
        $image = 'notfound.jpg';
        if(!empty($fileName))
        {
            if(file_exists(static::getImageFile($fileName)))
            {
                $image= $fileName;
            }
        }
        return Yii::$app->urlManager->createAbsoluteUrl(['image/get-image', 'file'=> $image]);
    }
    
    public static function deleteImage($fileName)
    {
        $file = static::getImageFile($fileName);
        if (empty($file) || !file_exists($file)) {
            return false;
        }
        if (!unlink($file)) {
            return false;
        }
        return true;
    }
    
    public static function deleteListImages($listImages)
    {
        if(empty($listImages))
        {
            return;
        }
        foreach($listImages as $imageName)
        {
            static::deleteImage($imageName);
        }
    }
    
    public static function saveImagesAs($listImages, $listPath)
    {
        assert('count($listImages) == count($listPath)');
        $count= count($listImages);
        for($i= 0; $i< $count; $i++)
        {
            $image= $listImages[$i];
            $path= $listPath[$i];
            $image->saveAs($path);
        }
    }
    
    public static function getImageName($imagePath)
    {
        $parts= explode(DIRECTORY_SEPARATOR, $imagePath);
        return $parts[count($parts)- 1];
    }
}
