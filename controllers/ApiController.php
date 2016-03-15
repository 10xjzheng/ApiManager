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
        $query = Project::find()->where('projectId > 0');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['projectId' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
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
            'model' => $model,
            'dataProvider' => $dataProvider,

        ]);
    }

    public function actionApiInfo()
    {
        $apiId=$_GET['apiId'];
        $model=new Api();
        $data = $model::find()->where('fkProjectId='.$_GET['id'])->all();
        if($apiId>0)  $model=$model::find()->with('project')->where('apiId='.$apiId)->one();
        else $model=$model::find()->with('project')->where('fkProjectId='.$_GET['id'])->one();
        // var_dump($apiInfo-project);exit;
        $project = new Project();
        $projectName = Project::findOne($_GET['id'])->projectName;
        $url='';
        if(count($data)==0) return $this->redirect(['add-api','id'=>$_GET['id'],'apiId'=>$apiId]);
        return $this->render('apiInfo', [
            'model' => $model,
            'data'=>$data,
            'apiInfo'=>$model,
            'projectName'=>$projectName,
        ]);
    }
    public function actionAddApi()
    {
        $model = new Api();
       //保存修改
        if (Yii::$app->request->isPost) {
            if($_POST['apiId']>0) $model = Api::findOne($_POST['apiId']);
            $model->load(Yii::$app->request->post());
            $model->userId=1;
            $model->fkProjectId=$_POST['id'];
            $model->lastTime=date('Y-m-d H:i:s',time());
            if(isset($_POST['p']))$model->params=serialize($_POST['p']);
            if(isset($_POST['r']))$model->returnParams=serialize($_POST['r']);
            // var_dump($model->save());exit;
            if($model->save()) return $this->redirect(['api-info','id'=>$model->fkProjectId,'apiId'=>$model->apiId]);
            Yii::$app->session->setFlash('success', '您已成功添加接口：'.$model->projectName);
        }

        $data = $model::find()->where('fkProjectId='.$_GET['id'])->all();
        $project = new Project();
        $projectName = Project::findOne($_GET['id'])->projectName;
        $apiId=$_GET['apiId'];
        $apiInfo=new Api();
        if($apiId>0) $apiInfo=$model::find()->with('project')->where('apiId='.$apiId)->one(); 
        return $this->render('addApi', [
            'model' => $model,
            'apiInfo'=>$apiInfo,
            'data'=>$data,
            'projectName'=>$projectName,
        ]);
    }
    public function actionDel() 
    { 
        $status='{"code":-1}';
        if (Yii::$app->request->isAjax&&isset($_POST['apiId'])){ 
            $model=new Api();
            $model = Api::deleteAll('apiId='.$_POST['apiId']);
            if($model) $status='{"code":0}';
        }
        echo $status;
    } 

     public static function actionRequest(){//file_get_content
        $data=$_POST;
        $url=$data['url'];
        $requestData = http_build_query($data);
        $result='';
        if($data['type']=="POST"){
            $opts = array('http' =>
            array(
              'method'  => $data['type'],
              'header'  => 'Content-type: application/x-www-form-urlencoded',
              'content' => $requestData
            )
            );
            $context = stream_context_create($opts);
            $result = file_get_contents($url, false, $context);
        }else if($data['type']=="GET"){
            $result = file_get_contents($url.'?'.$requestData);
        }
        echo $result;
    }
 
}
