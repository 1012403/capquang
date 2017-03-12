<?php

namespace common\models;

use common\utils\StringsUtil;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $sort
 * @property string $parent_category_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 */
class NewsCategory extends Item
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_category';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'unique'],
            // [['alias', 'meta_keyword', 'meta_title', 'meta_description'], 'required'],
            [['sort'], 'integer', 'min'=> 0],
            [['name', 'alias', 'meta_title', 'meta_keyword'], 'string', 'max' => 255],
            [['meta_description'], 'string', 'max' => 500],
            [['created_at', 'updated_at', 'image'], 'safe'],
            [['created_by', 'updated_by', 'parent_category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_category_id' => 'Danh mục cha',
            'name' => 'Name',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'alias' => 'Alias',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
        ];
    }
    
    public function getNews()
    {
        return  $this->hasMany(News::className(), ['news_category_id'=> 'id']);
    }
    
    public function getSubCategories()
    {
        return  $this->hasMany(News::className(), ['parent_category_id'=> 'id']);
    }
    
    public function getParentCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id'=> 'parent_category_id']);
    }
    
    public static function getArrayNewsCategory()
    {
        return ArrayHelper::map(static::find()->orderBy("sort")->asArray()->all(), 'id', 'name');
    }
    
    public static function getArrayParentNewsCategory($id)
    {
        return ArrayHelper::map(static::find()->andWhere(['!=' , 'id', $id])->orderBy("sort")->asArray()->all(), 'id', 'name');
    }
    
    public function beforeValidate() {
        if($this->getScenario() !== 'search') {
            if(!$this->alias) {
                $this->alias = StringsUtil::vtalias($this->name);
            }
            else {
                $this->alias = StringsUtil::vtalias($this->alias);
            }
            if(!$this->meta_title) {
                $this->meta_title = $this->name . ($this->parentCategory ?  ('-' . $this->parentCategory->name) : '');
            }
        }
        return parent::beforeValidate();
    }
}
