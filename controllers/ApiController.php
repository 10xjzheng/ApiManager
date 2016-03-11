<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\Api;
use yii\web\Response;
use yii\web\request;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
class ApiController extends \yii\web\Controller
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        $query = Project::find()->where('projectId > 0');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['projectId' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 100,
            ]
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
   /**
     * 添加项目
     */
    public function actionAddProject()
    {
        $model = new Project();
        $model->load(Yii::$app->request->post());
        
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        if (Yii::$app->request->isPost && $model->save()) {
            // Yii::$app->session->setFlash('success', '您已成功添加项目：'.$model->projectName);
            return $this->redirect(['index']);
        }
    
        return $this->render('addProject', [
            'model' => $model
        ]);
    }

    public function actionApiInfo($id=null)
    {
        $model=new Api();
        $data = $model::find()->where('fkProjectId=1')->all();
        if($id>0)  $apiInfo=$model::find()->with('project')->where('apiId='.$id)->one();
        else $apiInfo=$model::find()->with('project')->where('fkProjectId=1')->one();
        // var_dump($apiInfo->project);exit;
        return $this->render('apiInfo', [
            'model' => $model,'data'=>$data,'apiInfo'=>$apiInfo
        ]);
    }
    public function actionAddApi()
    {
        //var_dump($_POST);
        $model = new Api();
        $model->load(Yii::$app->request->post());
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if (Yii::$app->request->isPost) {
            $model->userId=1;
            $model->fkProjectId=1;
            $model->lastTime=date('Y-m-d H:i:s',time());
            $model->params=serialize($_POST['p']);
            $model->returnParams=serialize($_POST['r']);
           // var_dump($model);
           // var_dump($model->save());
            if($model->save()) return $this->redirect(['index']);
            // Yii::$app->session->setFlash('success', '您已成功添加接口：'.$model->projectName);
        }
        return $this->render('addApi', [
            'model' => $model,
        ]);
    }
}
