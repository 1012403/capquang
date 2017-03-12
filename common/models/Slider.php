<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "slider".
 *
 * @property string $image1
 * @property string $image2
 * @property string $image3
 * @property string $image4
 * @property string $link1
 * @property string $link2
 * @property string $link3
 * @property string $link4
 */
class Slider extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image1', 'link1'], 'required'],
            [['image1', 'image2', 'image3', 'image4'], 'string'],
            [['link1', 'link2', 'link3', 'link4'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image1' => 'Hình 1',
            'image2' => 'Hình 2',
            'image3' => 'Hình 3',
            'image4' => 'Hình 4',
            'link1' => 'Link 1',
            'link2' => 'Link 2',
            'link3' => 'Link 3',
            'link4' => 'Link 4',
        ];
    }
    
    public static function getArraySliderImages() {
        $slider = static::find()->one();
        $images = [[
            'link' => $slider->link1,
            'image' => $slider->image1
         ]];
        if($slider->image2) {
            $images[] = [
            'link' => $slider->link2,
            'image' => $slider->image2
         ];
        }
        if($slider->image3) {
            $images[] = [
            'link' => $slider->link3,
            'image' => $slider->image3
         ];
        }
        if($slider->image4) {
            $images[] = [
            'link' => $slider->link4,
            'image' => $slider->image4
         ];
        }
        return $images;
    }
}
