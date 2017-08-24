<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Employee2 */

$this->title = 'Create Employee2';
$this->params['breadcrumbs'][] = ['label' => 'Employee2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
