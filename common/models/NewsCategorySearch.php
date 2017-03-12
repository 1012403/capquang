<?php

namespace common\models;

use common\utils\StringsUtil;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NewsCategorySearch represents the model behind the search form about `common\models\NewsCategory`.
 */
class NewsCategorySearch extends NewsCategory
{
    public function init() {
        $this->setScenario('search');
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'meta_keyword', 'parent_category_id',
                'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        $scenarios = Model::scenarios();
        return ['search' => $scenarios['default']];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = NewsCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'parent_category_id' => $this->parent_category_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'alias', $this->alias]);
        $query->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword]);
        StringsUtil::processFilterDate($query, "created_at", $this->created_at);
        StringsUtil::processFilterDate($query, "updated_at", $this->updated_at);

        return $dataProvider;
    }
}
