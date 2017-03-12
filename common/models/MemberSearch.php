<?php

namespace common\models;

use common\utils\StringsUtil;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MemberSearch represents the model behind the search form about `common\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'name', 'phone', 'username', 'city', 'district', 'ward', 'address',
                'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Member::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'updated_by' => $this->updated_by,
            'updated_by' => $this->updated_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'phone', $this->phone]);
        $query->andFilterWhere(['like', 'username', $this->username]);
        $query->andFilterWhere(['like', 'city', $this->alias]);
        $query->andFilterWhere(['like', 'district', $this->district]);
        $query->andFilterWhere(['like', 'ward', $this->ward]);
        $query->andFilterWhere(['like', 'address', $this->alias]);
        StringsUtil::processFilterDate($query, "created_at", $this->created_at);
        StringsUtil::processFilterDate($query, "updated_at", $this->updated_at);

        return $dataProvider;
    }
}
