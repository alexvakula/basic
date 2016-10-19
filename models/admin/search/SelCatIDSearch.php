<?php

namespace app\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SelCatId;

/**
 * SelCatIdSearch represents the model behind the search form about `app\models\SelCatId`.
 */
class SelCatIdSearch extends SelCatId
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'executor_id', 'category_id'], 'integer'],
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
        $query = SelCatId::find()
	->joinWith(['category']
	->joinWith(['executor'], false);;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'executor_id' => $this->executor_id,
            'category_id' => $this->category_id,
        ]);

        return $dataProvider;
    }
}
