<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\facility;

/**
 * facilitySearch represents the model behind the search form about `app\models\facility`.
 */
class facilitySearch extends facility
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'checklist_id'], 'integer'],
            [['facility_type', 'facility_status', 'facility_qrcode'], 'safe'],
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
        $query = facility::find();

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
            'checklist_id' => $this->checklist_id,
        ]);

        $query->andFilterWhere(['like', 'facility_type', $this->facility_type])
            ->andFilterWhere(['like', 'facility_status', $this->facility_status])
            ->andFilterWhere(['like', 'facility_qrcode', $this->facility_qrcode]);

        return $dataProvider;
    }
}
