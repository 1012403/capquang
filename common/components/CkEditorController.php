<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace common\components;

use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\UploadedFile;
/**
 * Description of CkEditorController
 *
 * @author TienDang
 */
class CkEditorController extends Controller{
    
    public $enableCsrfValidation = false;
    
     public function  actionUpload()
     {
        $uploadedFile = UploadedFile::getInstanceByName('upload'); 
        $mime = FileHelper::getMimeType($uploadedFile->tempName);
        $file = time()."_".$uploadedFile->name;
        
        $url = Yii::$app->urlManager->createAbsoluteUrl('/images/'.$file);
        $uploadPath = Yii::getAlias('@webroot').'/images/'.$file;
        //extensive suitability check before doing anything with the file…
        if ($uploadedFile==null)
        {
           $message = "No file uploaded.";
        }
        else if ($uploadedFile->size == 0)
        {
           $message = "The file is of zero length.";
        }
        else if ($mime!="image/jpeg" && $mime!="image/png")
        {
           $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
        }
        else if ($uploadedFile->tempName==null)
        {
           $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
        }
        else {
          $message = "";
          $move = $uploadedFile->saveAs($uploadPath);
          if(!$move)
          {
             $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
          } 
        }
        $funcNum = $_GET['CKEditorFuncNum'] ;
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";    
    
     }
}
