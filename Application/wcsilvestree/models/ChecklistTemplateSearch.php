<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ChecklistTemplate;

/**
 * ChecklistTemplateSearch represents the model behind the search form about `app\models\ChecklistTemplate`.
 */
class ChecklistTemplateSearch extends ChecklistTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'checklist_template_equipment_number', 'checklist_id'], 'integer'],
            [['checklist_template_type', 'checklist_template_equipment', 'checklist_template_equipment_description'], 'safe'],
            [['checklist_template_temperature'], 'number'],
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
        $query = ChecklistTemplate::find();

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
            'checklist_template_temperature' => $this->checklist_template_temperature,
            'checklist_template_equipment_number' => $this->checklist_template_equipment_number,
            'checklist_id' => $this->checklist_id,
        ]);

        $query->andFilterWhere(['like', 'checklist_template_type', $this->checklist_template_type])
            ->andFilterWhere(['like', 'checklist_template_equipment', $this->checklist_template_equipment])
            ->andFilterWhere(['like', 'checklist_template_equipment_description', $this->checklist_template_equipment_description]);

        return $dataProvider;
    }
}
