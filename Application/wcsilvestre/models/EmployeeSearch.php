<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `app\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'employee_number'], 'integer'],
            [['employee_lastname', 'employee_firstname', 'employee_email', 'employee_occupation', 'employee_user_type'], 'safe'],
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
        $query = Employee::find();

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
            'employee_number' => $this->employee_number,
        ]);

        $query->andFilterWhere(['like', 'employee_lastname', $this->employee_lastname])
            ->andFilterWhere(['like', 'employee_firstname', $this->employee_firstname])
            ->andFilterWhere(['like', 'employee_email', $this->employee_email])
            ->andFilterWhere(['like', 'employee_occupation', $this->employee_occupation])
            ->andFilterWhere(['like', 'employee_user_type', $this->employee_user_type]);

        return $dataProvider;
    }
}
