<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChecklistTemplate */

$this->title = 'Update Checklist Template: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Checklist Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'checklist_id' => $model->checklist_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="checklist-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
