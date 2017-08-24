<?php

namespace app\controllers;

use Yii;
use app\models\Employee;
use app\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;


/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends ActiveController
{
    /**
     * @inheritdoc
     */

    public $modelClass = 'app\models\Employee';

}
