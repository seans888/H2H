<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Checklist;

/**
 * ChecklistSearch represents the model behind the search form about `app\models\Checklist`.
 */
class ChecklistSearch extends Checklist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'checklist_quantity_on_hand'], 'integer'],
            [['checklist_equipment'], 'safe'],
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
        $query = Checklist::find();

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
            'checklist_quantity_on_hand' => $this->checklist_quantity_on_hand,
        ]);

        $query->andFilterWhere(['like', 'checklist_equipment', $this->checklist_equipment]);

        return $dataProvider;
    }
}
