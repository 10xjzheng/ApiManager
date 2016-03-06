<?php

namespace app\controllers;
use app\models\ProjectForm;
use app\models\ApiForm;

class ApiController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAddProject()
    {
        $model = new ProjectForm();
        return $this->render('addProject', [
            'model' => $model,
        ]);
    }
    public function actionApiInfo()
    {
        return $this->render('apiInfo');
    }
    public function actionAddApi()
    {
        $model = new ApiForm();
        return $this->render('addApi', [
            'model' => $model,
        ]);
    }
}
