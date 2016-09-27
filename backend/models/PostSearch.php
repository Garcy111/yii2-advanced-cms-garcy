<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\modules\admin\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'access'], 'integer'],
            [['link', 'title'], 'safe'],
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
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => 'SORT_DESC',
                ],
            ],
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            // 'id' => $this->id,
            'category_id' => $this->category_id,
            'access' => $this->access,
        ]);

        $query->andFilterWhere(['like', 'link', $this->link])
        // ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}