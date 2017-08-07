<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checklist".
 *
 * @property integer $id
 * @property string $checklist_equipment
 * @property string $checklist_quantity_on_hand
 *
 * @property Facility[] $facilities
 */
class Checklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['checklist_equipment', 'checklist_quantity_on_hand'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'checklist_equipment' => 'Checklist Equipment',
            'checklist_quantity_on_hand' => 'Checklist Quantity On Hand',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacilities()
    {
        return $this->hasMany(Facility::className(), ['checklist_id' => 'id']);
    }
}
