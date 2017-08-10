<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ChecklistTemplate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Checklist Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checklist-template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'checklist_id' => $model->checklist_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'checklist_id' => $model->checklist_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'checklist_template_type',
            'checklist_template_equipment',
            'checklist_template_temperature',
            'checklist_template_equipment_number',
            'checklist_template_equipment_description',
            'checklist_id',
        ],
    ]) ?>

</div>
