<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comerciante;

/**
 * ComercianteSearch represents the model behind the search form about `app\models\Comerciante`.
 */
class ComercianteSearch extends Comerciante
{
    /**
     * @inheritdoc
     */



    public function rules()
    {
        return [
            [['rubro_id'], 'integer'],
            [['nombres_y_apellidos','tipo', 'cedula', 'estado_civil', 'fecha_nacimiento', 'sexo', 'correo', 'tiempo','direccion','telefono'], 'safe'],
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
        $query = Comerciante::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
            'pageSize' => 100,
            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'rubro_id' => $this->rubro_id,
            'sexo'=>$this->sexo,
            'tipo'=>$this->tipo,
        ]);

        $query->andFilterWhere(['like', 'nombres_y_apellidos', strtoupper($this->nombres_y_apellidos)])
            ->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like','telefono',$this->telefono]);

        return $dataProvider;
    }
}
