<?php

namespace common\models;

use Yii;
use common\utils\StringsUtil;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_content
 * @property string $content
 * @property string $image
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $alias
 * @property integer $meta_title
 * @property integer $meta_keyword
 * @property integer $meta_description
 */
class News extends Item
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'meta_keyword', 'short_content'], 'string'],
            [['title', 'content', 'image'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'news_category_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['image', 'tag'], 'string'],
            [['alias', 'meta_keyword', 'meta_title'], 'string', 'max' => 255],
            [['meta_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_category_id' => 'Chuyên mục tin tức',
            'title' => 'Title',
            'content' => 'Nội dung tin tức',
            'short_content' => 'Nội dung tóm tắt',
            'image' => 'Image',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'meta_title'=> 'Meta Tag Title',
            'meta_keyword'=> 'Meta Tag Keywords',
            'meta_description'=> 'Meta Tag Description'
        ];
    }
    
    public function getNewsCategory() {
        return $this->hasOne(NewsCategory::className(), ['id' => 'news_category_id']);
    }
    
    public function beforeValidate() {
        if($this->getScenario() !== 'search') {
            if(!$this->alias) {
                $this->alias = StringsUtil::vtalias($this->title);
            }
            else {
                StringsUtil::vtalias($this->alias);
            }
            if(!$this->meta_title) {
                $this->meta_title = $this->title;
            }
        }
        return parent::beforeValidate();
    }
    
    public function getRalateNews() {
        $tags = explode(',', $this->tag);
        $relate_news = [];
        foreach($tags as $tag) {
            $arr = News::find()->andFilterWhere(['like', 'tag', trim($tag)])
                    ->andWhere(['!=', 'id', $this->id])->all();
            foreach($arr as $item) {
                $relate_news[$item->id] = $item;
            }
        }
        return $relate_news;
    }
}
