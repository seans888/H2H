<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Schedule1 */

$this->title = 'Create Schedule1';
$this->params['breadcrumbs'][] = ['label' => 'Schedule1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
