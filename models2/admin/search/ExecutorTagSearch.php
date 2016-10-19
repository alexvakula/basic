<?php

namespace app\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExecutorTag;

/**
 * ExecutorTagSearch represents the model behind the search form about `app\models\ExecutorTag`.
 */
class ExecutorTagSearch extends ExecutorTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['executor_id', 'tag_id'], 'integer'],
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
        $query = ExecutorTag::find()->with(['executor', 'tag']);

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
            'executor_id' => $this->executor_id,
            'tag_id' => $this->tag_id,
        ]);

        return $dataProvider;
    }
}
