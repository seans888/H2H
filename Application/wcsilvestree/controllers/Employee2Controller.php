<?php

namespace app\controllers;

use Yii;
use app\models\Employee2;
use app\models\Employee2Search;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
