<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $url
 * @property string $sort
 */
class Menu extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['title', 'url'], 'string'],
            [['parent_id', 'sort'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'parent_id' => 'Parent',
            'sort' => 'Sort',
        ];
    }
    
    public function getParent() {
        return $this->hasOne(static::className(), ['id' => 'parent_id']);
    }
    
    public function getChildren() {
        return $this->hasMany(static::className(), ['parent_id' => 'id']);
    }
    
    public static function getArrayCategory() {
        return ArrayHelper::map(static::find()->orderBy('id')->asArray()->all(), 'id', 'title');
    }
    
    public static function getArrayParentMenu($id) {
        return  ArrayHelper::map(static::find()->andFilterWhere(['!=', 'id', $id])
                ->orderBy('id')->asArray()->all(), 'id', 'title');
    }
}
