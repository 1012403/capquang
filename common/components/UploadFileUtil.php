<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use ErrorException;
use Exception;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * Description of UploadFileUtil
 *
 * @author Shao
 */
class UploadFileUtil {

    const DELIMITER = '__';

    public static function resolveUploadFile($model, $attribute, $tempAttribute = 'file') {
        $files = UploadedFile::getInstances($model, $tempAttribute);
        if ($files != null) {
            $fileUploads = [];
            foreach ($files as $file) {
                $filename = $file->baseName . static::DELIMITER . time() . '.' . $file->extension;
                $path = Yii::getAlias('@webroot') . '/uploads/' . $filename;
                if ($file->saveAs($path)) {
                    $fileUploads[$file->name] = $filename;
                }
            }
            static::deleteOldUploadedFile($model, $attribute);
            $model->{$attribute} = Json::encode($fileUploads);
            $model->save();
        }
    }

    public static function deleteOldUploadedFile($model, $attribute) {
        try {
            if ($model->{$attribute} != null) {
                $oldUploadedFiles = Json::decode($model->{$attribute});
                foreach ($oldUploadedFiles as $name => $filename) {
                    $filePath = static::getFilePath($filename);
                    unlink($filePath);
                }
            }
        } catch (ErrorException $er) {
            
        } catch (Exception $ex) {
            
        }
    }

    public static function getFilePath($filename) {
        return Yii::getAlias('@backend') . '/web/uploads/' . $filename;
    }

    public static function getFileuploadView($model, $attribute = 'fileupload') {
        $listFile = "";
        if ($model->{$attribute} != null) {
            $fileUploadData = Json::decode($model->{$attribute});
            foreach ($fileUploadData as $name => $filename) {
                $listFile .= Html::a($name, Yii::$app->urlManager->createUrl(['site/download', 'file' => $filename])) . "; ";
            }
            $listFile = rtrim($listFile, "; ");
            return $listFile;
        }
    }

    public static function getFileUploadCaption($model, $attribute = 'fileupload') {
        $initCaption = Yii::t('yii', '(not set)');
        if ($model->{$attribute} != null) {
            $fileUploadData = Json::decode($model->{$attribute});
            $initCaption = '<div class="file-caption-name" title="' . count($fileUploadData) . ' files selected"><span class="glyphicon glyphicon-file kv-caption-icon"></span></div>' .
                    count($fileUploadData) . ' files selected';
        }
        return $initCaption;
    }

}
