<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChecklistTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checklist-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'checklist_template_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checklist_template_equipment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checklist_template_temperature')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checklist_template_equipment_number')->textInput() ?>

    <?= $form->field($model, 'checklist_template_equipment_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checklist_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
