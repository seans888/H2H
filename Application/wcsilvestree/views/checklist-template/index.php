<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChecklistTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checklist Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checklist-template-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Checklist Template', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'checklist_template_type',
            'checklist_template_equipment',
            'checklist_template_temperature',
            'checklist_template_equipment_number',
            // 'checklist_template_equipment_description',
            // 'checklist_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
