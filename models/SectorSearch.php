<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sector;

/**
 * SectorSearch represents the model behind the search form about `app\models\Sector`.
 */
class SectorSearch extends Sector
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'municipio_id', 'parroquia_id'], 'integer'],
            [['sector'], 'safe'],
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
        $query = Sector::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
            'pageSize' => 100,
            ],
        ]);

        $query->joinWith('parroquia');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'municipio_id' => $this->municipio_id,
            'parroquia_id' => $this->parroquia_id,
        ]);

        $query->andFilterWhere(['like', 'sector', $this->sector]);
        //->andFilterWhere(['like','parroquia.parroquia',$this->parroquia_id]);

        return $dataProvider;
    }
}
