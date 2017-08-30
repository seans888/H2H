<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Employee2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employee2s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee2-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Employee2', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'employee_lastname',
            'employee_firstname',
            'employee_number',
            'employee_email:email',
            // 'employee_occupation',
            // 'employee_user_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
