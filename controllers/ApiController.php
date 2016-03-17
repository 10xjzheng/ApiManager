<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\Api;
use app\models\ModifyLogs;
use yii\web\Response;
use yii\web\request;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
class ApiController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }else{
            return true;
        }
        if (!parent::beforeAction($action)) {
            return false;
        }
    }
    /**
     * 首页
     */
    public function actionIndex()
    {
       /*分页处理，这里不需要*/
       /* $query = Project::find()->where('projectId > 0');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['projectId' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 100,
            ]
        ]);*/
        $data = Project::find()->where('projectId > 0')->orderBy("projectId desc")->all();
        return $this->render('index', [
            'data' => $data,
        ]);
    }
   /**
     * 添加项目
     */
    public function actionAddProject()
    {
        $model = new Project();
        $data = Project::find()->where('projectId > 0')->orderBy("projectId desc")->all();
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
            'data' => $data,
        ]);
    }
   /**
     * 接口信息
     */
    public function actionApiInfo()
    {
        if(!isset($_GET['id'])) {
            throw new \yii\web\UnauthorizedHttpException('Missing Params!');
            return false;
        }
        $model=new Api();
        if(!empty($_GET['apiId'])){
            $apiId=$_GET['apiId'];
            $model=$model::find()->with('project')->where('apiId='.$apiId)->one();
        }else $model=$model::find()->with('project')->where('fkProjectId='.$_GET['id'])->one();
        $data = Api::find()->where('fkProjectId='.$_GET['id'])->all();
        $projectName = Project::findOne($_GET['id'])->projectName;
        $url='';
        if(count($data)==0) return $this->redirect(['add-api','id'=>$_GET['id'],'apiId'=>$_GET['apiId']]);
        $logs=new ModifyLogs();
        $logsData = $logs::find()->where('apiId='.$model->apiId)->orderBy('editTime desc')->all();
        return $this->render('apiInfo', [
            'model' => $model,
            'data'=>$data,
            'projectName'=>$projectName,
            'logsData'=>$logsData,
        ]);
    }
    /**
     * 添加接口
     */
    public function actionAddApi()
    {
        $model = new Api();
       //保存修改
        if (Yii::$app->request->isPost) {
            // api接口数据，如果存在此apiId则修改，否则添加
            $now=date('Y-m-d H:i:s',time());
            if($_POST['apiId']>0) $model = Api::findOne($_POST['apiId']);
            $model->load(Yii::$app->request->post());
            $model->userId=Yii::$app->user->identity->id;
            $model->fkProjectId=$_POST['id'];
            $model->lastTime=$now;
            if(isset($_POST['p']))$model->params=serialize($_POST['p']);
            if(isset($_POST['r']))$model->returnParams=serialize($_POST['r']);
            // 事务开始
            $transaction = Yii::$app->db->beginTransaction();
            $flag1=$model->save();
            // log数据
            $logs = new ModifyLogs();
            $logs->content=$_POST['log'];
            $logs->editTime=$now;
            $logs->apiId=$model->apiId;
            $logs->userId=Yii::$app->user->identity->id;
            
            $flag2=$logs->save();
            Yii::$app->session->setFlash('success', '您已成功编辑接口：'.$model->apiName);
            //二者都成功则提交，否则回滚
            if($flag1&&$flag2){
                $transaction->commit();
                return $this->redirect(['api-info','id'=>$model->fkProjectId,'apiId'=>$model->apiId]);
            }else{
                $transaction->rollBack();
                throw new \yii\web\UnauthorizedHttpException('Missing Params!');
            }
        }
        //展示添加或编辑页面
        if(isset($_GET['id'])&&isset($_GET['apiId'])){
            $project = new Project();
            $data = $model::find()->where('fkProjectId='.$_GET['id'])->all();       
            $projectName = Project::findOne($_GET['id'])->projectName;
            $apiId=$_GET['apiId'];
            if($apiId>0) $model=$model::find()->with('project')->where('apiId='.$apiId)->one(); 
            return $this->render('addApi', [
            'model' => $model,
            'data'=>$data,
                'projectName'=>$projectName,
            ]);
        }else{
            throw new \yii\web\UnauthorizedHttpException('Missing Params!');
        }
    }
    /**
     * 删除接口
     */
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
    /**
     * 测试接口
     */
     public static function actionRequest(){//file_get_content
        header("Content-type: text/html; charset=utf-8"); 
        $data=$_POST;
        $url=$data['url'];
        $type=$data['methodType'];
        unset($data['url']);
        unset($data['methodType']);
        $requestData = http_build_query($data);
        $result='';
        if($type="POST"){
            $opts = array('http' =>
            array(
              'method'  => $type,
              'header'  => 'Content-type: application/x-www-form-urlencoded',
              'content' => $requestData
            )
            );
            $context = stream_context_create($opts);
            $result = file_get_contents($url, false, $context);
        }else if($type=="GET"){
            $result = file_get_contents($url.'?'.$requestData);
        }
        echo $result;
    }
     /**
     * 搜索接口/工程 
     * @param type:1 -->搜索接口，2-->搜索工程
     */
    public function actionSearch() 
    { 
        $data=array();
        if($_POST['type']==1){
            $model=new Api();
            $data = $model::find()->where("number like '%".$_POST['keywords']."%' or apiName like '%".$_POST['keywords']."%'")->all();
        }else if($_POST['type']==2){
            $model=new Project();
            $data = $model::find()->where("projectName like '%".$_POST['keywords']."%'")->all();
        }
        return \yii\helpers\Json::encode($data); 
    } 
}
