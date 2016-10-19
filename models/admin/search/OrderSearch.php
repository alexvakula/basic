<?php

namespace app\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{

    public $category_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'executor_id', 'customer_id', 'category_id', 'score'], 'integer'],
            [['task', 'feedback', 'photo_before', 'photo_after'], 'safe'],
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
        $query = Order::find()->joinWith('category', false);

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
            'order.id' => $this->id,
            'order.executor_id' => $this->executor_id,
            'order.customer_id' => $this->customer_id,
            'order.category_id' => $this->category_id,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'task', $this->task])
            ->andFilterWhere(['like', 'feedback', $this->feedback]);

        return $dataProvider;
    }
}
