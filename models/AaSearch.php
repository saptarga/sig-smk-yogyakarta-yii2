<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aa;

/**
 * AaSearch represents the model behind the search form of `app\models\Aa`.
 */
class AaSearch extends Aa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r', 'e', 'f', 'g'], 'integer'],
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
        $query = Aa::find();

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
            'r' => $this->r,
            'e' => $this->e,
            'f' => $this->f,
            'g' => $this->g,
        ]);

        return $dataProvider;
    }
}
