<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ChecklistTemplate */

$this->title = 'Create Checklist Template';
$this->params['breadcrumbs'][] = ['label' => 'Checklist Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checklist-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
