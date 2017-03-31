<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Novel;

/**
 * NovelSearch represents the model behind the search form of `common\models\Novel`.
 */
class NovelSearch extends Novel
{
    public function attributes()
    {
        return array_merge(parent::attributes(),['authorName']);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),['authorName'=>'作者']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'is_top', 'is_hot', 'is_best', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'content', 'tags','authorName'], 'safe'],
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
        $query = Novel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pagesize'=>'2',
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
            'id' => $this->id,
            'status' => $this->status,
            'is_top' => $this->is_top,
            'is_hot' => $this->is_hot,
            'is_best' => $this->is_best,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        $query->join('INNER JOIN','author','novel.author_id = author.userid')
            ->andFilterWhere(['like','pseudonym',$this->authorName]);

        //添加排序
//        $dataProvider->sort->attributes['authorName'] = [
//            'asc'=>['authorName'=>SORT_ASC],
//            'desc'=>['authorName'=>SORT_DESC],
//        ];

        //设置默认排序
        $dataProvider->sort->defaultOrder = [
            'status'=>SORT_ASC,
            'id'=>SORT_DESC,
        ];

//        $dataProvider->sort->attributes = [
//            'id',
//        ];
        return $dataProvider;
    }
}
