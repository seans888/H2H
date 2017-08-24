<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Employee2Controller implements the CRUD actions for Employee2 model.
 */
class Employee2Controller extends ActiveController
{
    /**
     * @inheritdoc
     */

    public $modelClass = 'app\models\Employee2';
}
