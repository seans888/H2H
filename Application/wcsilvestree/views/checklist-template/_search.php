<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChecklistTemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checklist-template-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'checklist_template_type') ?>

    <?= $form->field($model, 'checklist_template_equipment') ?>

    <?= $form->field($model, 'checklist_template_temperature') ?>

    <?= $form->field($model, 'checklist_template_equipment_number') ?>

    <?php // echo $form->field($model, 'checklist_template_equipment_description') ?>

    <?php // echo $form->field($model, 'checklist_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
