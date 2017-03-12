<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $setting_data
 * @property string $name
 * @property string $update_at
 * @property string $update_by
 */
class Setting extends \common\models\Item
{

    //web setting
    public $facebookLink;
    public $twitterLink;
    public $instagramLink;
    public $linkedInLink;

    //contact setting
    public $mapImage;
    
    //xai chung

    public $title;
    
    public $description;
    
    public $meta_title;
    
    public $meta_keywords;
    
    public $meta_description;
    
    //footer setting
    public $address;
    public $tel;
    public $email;
    public $map;
    
    protected $_settingData= [];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }
    
    public static function populateRecord($record, $row) {
        parent::populateRecord($record, $row);
        $record->_settingData= json_decode($record->setting_data, true);
        if(is_array($record->_settingData))
        {
            foreach($record->_settingData as $name=> $value)
            {
                $record->$name= $value;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_data'], 'string'],
            [['updated_at', 'updated_by'], 'safe'],
            [['default_news'], 'required'],

            //setting attributes
            [['title', 'description'], 'string'],
            [['meta_title', 'meta_keywords', 'meta_description'], 'required'],
        ];
    }
    
    protected function settingAttributes() {
        return ['tel', 'email', 'address',
            'facebookLink', 'twitterLink', 'instagramLink', 'linkedInLink',
            'title', 'description',
            'meta_title', 'meta_keywords', 'meta_description',
        ];
    }
    
    protected function hasSettingAttributes($name) {
        return in_array($name, $this->settingAttributes());
    }
    
    public function __set($name, $value) {
        if($this->hasSettingAttributes($name))
        {
            $this->_settingData[$name]= $value;
        }
        parent::__set($name, $value);
    }
    
    public function setAttribute($name, $value) {
        if($this->hasSettingAttributes($name))
        {
            $this->_settingData[$name]= $value;
        }
        parent::setAttribute($name, $value);
    }
    
    public function setAttributes($values, $safeOnly = true) {
        parent::setAttributes($values, $safeOnly);
        if (is_array($values)) {
            $settingAttributes= $this->settingAttributes();
            foreach ($values as $name => $value) {
                if(in_array($name, $settingAttributes))
                {
                    $this->_settingData[$name]= $value;
                }
            }
        }
    }
    
    public function save($runValidation = true, $attributeNames = null) {
        $this->setting_data= json_encode($this->_settingData);
        return parent::save($runValidation, $attributeNames);
    }
    
    public function delete() {
        return false;
    }

    public function attributeLabels()
    {
        return [
            'default_news' => 'Bài viết mặc định',
            'setting_data' => 'Setting Data',
            'update_at' => 'Update At',
            'update_by' => 'Update By',
            'meta_title' => 'Meta tag mặc định', 
            'meta_keywords' => 'Meta keywords mặc định',
            'meta_description' => 'Meta description mặc định',
        ];
    }
}
