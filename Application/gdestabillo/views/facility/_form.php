<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Checklist;

/* @var $this yii\web\View */
/* @var $model app\models\Facility */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facility-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'facility_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facility_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facility_qrcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checklist_id')->textInput() ?>
    <?= $form->field($model, 'checklist_id')->dropDownList(
        ArrayHelper::map(Checklist::find()->all(), 'id', 'id'),
        ['prompt'=>'Select Checklist']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
