<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stats;

/**
 * StatsSearch represents the model behind the search form of `app\models\Stats`.
 */
class StatsSearch extends Stats
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['employee_name', 'set_complete', 'status',  'medical_activity',  'category'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Stats::find();

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
            'employee_name' => $this->employee_name,
            'status' => $this->status,
            'category' => $this->category,
            'medical_activity' => $this->medical_activity,
            'set_complete' => $this->set_complete,
        ]);

        $query->andFilterWhere(['like', 'employee_name', $this->employee_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'medical_activity', $this->medical_activity])
            ->andFilterWhere(['like', 'set_complete', $this->set_complete]);

        return $dataProvider;
    }
}
