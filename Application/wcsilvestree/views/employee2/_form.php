<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Employee2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee2-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_number')->textInput() ?>

    <?= $form->field($model, 'employee_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_user_type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
