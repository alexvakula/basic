<?php

namespace app\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\models\Executor;
use app\models\Category;
use app\models\SelCatID;

/**
 * ExecutorSearch represents the model behind the search form about `app\models\Executor`.
 */
class ExecutorSearch extends Executor
{
    public $tag_id;

    public $category_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'tag_id', 'category_id', 'rate', 'active'], 'integer'],
            [['name', 'address', 'tel', 'content'], 'safe'],
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
        $query = Executor::find()->
          //  with(['tags'])->
          //  joinWith(['executorTags'], false)->
          //  joinWith(['selCatId'], false)->
            joinWith(['category'], false)
		->groupBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
      	  'pageSize' => '11',
    ],
/*	    'sort' => [
        'defaultOrder' => [
            'id' => SORT_ASC,  
        ]

    ],     */

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'executor.id' => $this->id,
     //       'executor.address' => $this->address,
            'executor.active' => $this->active,
        //    '{{%executor_tag}}.tag_id' => $this->tag_id,
            'sel_cat_id.category_id' => $this->category_id,
         

        ])->orFilterWhere(['category.parent_id' => $this->category_id]);

        $query->andFilterWhere(['like', 'executor.name', $this->name])
            ->andFilterWhere(['like', 'executor.address', $this->address])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
