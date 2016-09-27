<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\modules\admin\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'user_id', 'shipping', 'active', 'date'], 'integer'],
            [['products', 'quantity'], 'safe'],
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
        $query = Orders::find()->with(['address', 'user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => 'SORT_DESC',
                ],
            ],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'shipping' => $this->shipping,
            'active' => $this->active,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'products', $this->products])
            ->andFilterWhere(['like', 'quantity', $this->quantity]);

        return $dataProvider;
    }
}
