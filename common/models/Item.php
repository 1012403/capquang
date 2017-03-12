<?php

namespace common\models;

use common\components\TimestampBehavior;
use common\models\User;
use common\utils\StringsUtil;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Json;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item
 *
 * @author TienDang
 */
class Item extends ActiveRecord {

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
            BlameableBehavior::className()
        ];
    }
    
    /**
     * 
     * @param boolean $isLong
     * @return string
     */
    public function getCreatedBy() {
        if (isset($this->created_by)) {
            $createdBy = User::findOne($this->created_by);
            if (isset($createdBy)) {
                return $createdBy->username;
            }
            return "N/A";
        }
        return "N/A";
    }
    
    /**
     *
     * @param boolean $isLong
     * @return string
     */
    public function getUpdatedBy() {
        if (isset($this->updated_by)) {
            $updatedBy = User::findOne($this->updated_by);
            if (isset($updatedBy)) {
                return $updatedBy->username;
            }
            return "N/A";
        }
        return "N/A";
    }


    /**
     *
     * @param boolean $isLong
     * @return string
     */
    public function getCreatedByUser() {
        if (isset($this->created_by)) {
            return User::findOne($this->created_by);
        }
    }
    /**
     *
     * @param boolean $isLong
     * @return string
     */
    public function getUpdatedByUser() {
        if (isset($this->updated_by)) {
            return User::findOne($this->updated_by);
        }
    }

    public function getFileuploadView() {
        $listFile = "";
        if ($this->fileupload != null) {
            $fileUploadData = Json::decode($this->fileupload);
            foreach ($fileUploadData as $name => $filename) {
                $listFile .= Html::tag('a' ,StringsUtil::getExcerpt($name, 15) . '; ',
                    ['href' => Yii::$app->urlManager->createUrl(['site/download', 'file' => $filename]) ,
                                                    'title' => $name]);
            }
            $listFile = rtrim($listFile, "; ");
            return $listFile;
        }
    }
    
    public function getFileuploadIconView() {
        $listFile = "";
        if ($this->fileupload != null) {
            $fileUploadData = Json::decode($this->fileupload);
            foreach ($fileUploadData as $name => $filename) {
                $listFile .= Html::tag('a' , Html::img('/images/main/icon-file.png', ['style' => 'width:20px;height:20px']),
                    ['href' => Yii::$app->urlManager->createUrl(['site/download', 'file' => $filename]) ,
                                                    'title' => $name]);
            }
            $listFile = rtrim($listFile, "; ");
            return $listFile;
        }
    }

    public function getFileUploadCaption() {
        $initCaption = Yii::t('yii', '(not set)');
        if ($this->fileupload != null) {
            $fileUploadData = Json::decode($this->fileupload);
            $initCaption = '<div class="file-caption-name" title="' . count($fileUploadData) . ' files selected"><span class="glyphicon glyphicon-file kv-caption-icon"></span></div>' .
                    count($fileUploadData) . ' files selected';
        }
        return $initCaption;
    }
}
