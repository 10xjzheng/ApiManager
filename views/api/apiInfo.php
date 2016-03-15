<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = $projectName;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php include('_searchApi.php');?>
<div class="col-xs-9">
    <div class="col-xs-12 padding-5 margin-top-10" style="background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12"><span class="pull-right">最后修改者: root -- <?=$apiInfo->lastTime?></span></div>
        <div class="col-xs-12">
            <h4>
                <span class="pull-left"><b><?=$apiInfo->apiName?></b>-------编号: <span class="cl-red"><?=$apiInfo->number?></span></span>
                <span><a href= "<?= Url::to([ 'api/add-api', 'apiId'=>$apiInfo->apiId,'id'=>$_GET['id']]); ?>" class="pull-left btn btn-success" style="padding:2px 5px !important;margin-left:30px">编辑</a ></span>
                <span><button class="pull-left btn btn-danger" onclick="delApi(<?=$_GET['id']?>,<?=$apiInfo->apiId?>)" style="padding:2px 5px !important;margin-left:30px">删除</button></span>
            </h4> 
        </div>
        <div class="col-xs-12 margin-top-10">
            <span style="padding:2px;"><b><?=$apiInfo->type?></b></span>--
            <span style="padding:2px;" id="url"><?=$apiInfo->project->projectHost?><?=$apiInfo->functionName?></span>
        </div>
        <div class="col-xs-12 margin-top-10" ><b>描述</b>：<?=$apiInfo->apiDiscribe?></div>
    </div>

    <div class="col-xs-12 padding-5" style="margin:50px 0 0 0;background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12"><h4>请求参数</h4></div>
        <div class="col-xs-12">
            <table class="table">
              <thead>
                <tr><th>参数名</th><th>参数类型</th><th>必传</th><th>缺省值</th><th>描述</th></tr>
              </thead>
              <tbody>
                <?php
                    $params0=unserialize($apiInfo->params);
                    $pnum0 = count($params0['name']);
                    for( $i=0; $i<$pnum0; $i++ ) {
                ?>
                <tr>
                    <td><?=$params0['name'][$i]?></td>
                    <td><?=$params0['paramType'][$i]?></td>
                    <td><?=$params0['type'][$i]?></td>
                    <td><?=$params0['default'][$i]?></td>
                    <td><?=$params0['des'][$i]?></td>
                </tr>
                <?php
                    }
                ?>
              </tbody>    
            </table>
        </div>
    </div>

    <div class="col-xs-12 padding-5" style="margin:50px 0 0 0;background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12"><h4>返回参数</h4></div>
        <div class="col-xs-12">
            <table class="table">
              <thead>
                <tr><th>参数名</th><th>参数类型</th><th>缺省值</th><th>描述</th></tr>
              </thead>
              <tbody>
                 <?php
                    $params=unserialize($apiInfo->returnParams);
                    $pnum = count($params['name']);
                    for( $i=0; $i<$pnum; $i++ ) {
                        if($params['parent'][$i]=="1"){
                ?>
                        <tr>
                            <td><?=$params['name'][$i]?></td>
                            <td><?=$params['paramType'][$i]?></td>
                            <td><?=$params['default'][$i]?></td>
                            <td><?=$params['des'][$i]?></td>
                        </tr>
                <?php
                        }else{
                ?>
                        <tr style="text-align: center">
                            <td><?=$params['name'][$i]?></td>
                            <td><?=$params['paramType'][$i]?></td>
                            <td><?=$params['default'][$i]?></td>
                            <td><?=$params['des'][$i]?></td>
                        </tr>
                <?php
                        }
                    }
                ?>
              </tbody>    
            </table>
        </div>
    </div>
    <div>
       <div class="col-xs-12 padding-5" style="margin:50px 0 0 0;background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12"><h4>接口测试</h4></div>
        <div class="col-xs-12">
        <form id="test-form" method="<?=$apiInfo->type?>">
            <table class="table">
                <tr><th>参数</th><th>测试值</th></tr>
                <?php
                    for( $i=0; $i<$pnum0; $i++ ) {
                ?>
                <tr><td><?=$params0['name'][$i]?></td><td><input type="text" class="form-control"  name="<?=$params0['name'][$i]?>" /></td></tr>
                <?php }?>
            </table> 
        </form>
        </div>
      <div class="col-xs-12 margin-top-10"><button class="btn btn-primary" onclick="TestApi()">提交</button></div>
        <div class="col-xs-12 margin-top-10">
            <textarea class="form-control" id="jsonData" style="min-height: 500px">
                
            </textarea>
        </div>
    </div>
</div>
