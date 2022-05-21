<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PedidoDevuelto;


/**
 * PedidoDevueltoSearch represents the model behind the search form of `app\models\PedidoDevuelto`.
 */
class PedidoDevueltoSearch extends PedidoDevuelto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id'], 'safe']
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

    public function getIdFromName($data){
        //var_dump($data);
        //die();
        if($data != ""){
            
            //die();
            return $data->id;
        }
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
        $query = PedidoDevuelto::find();

        // add conditions that should always apply here

        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 4 ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if($this->cliente != NULL){
            echo $this->getIdFromName($this->cliente);
            die();
        }
        
        $query->andFilterWhere(['=', 'cliente_id', $this->cliente_id]);

        return $dataProvider;
    }
}
