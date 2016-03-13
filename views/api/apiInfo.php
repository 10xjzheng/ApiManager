<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = '接口信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-3 main-left margin-left-0 pull-left padding-5">
    <div>
        <form action="" method="post">
            <div style="margin:20px 0 0 0;">
                <div><input type="text" value="" class="form-control"  placeholder="Search..."></div>
                <?= Html::a('新建接口', ['api/add-api','id'=>0], ['class' => 'btn btn-success pull-right margin-top-10']) ?>
                <?php
                    foreach ($data as $key => $value) {
                ?>    
                    <a href= "<?= Url::to([ 'api/api-info', 'id'=>$value->apiId]); ?>" class="pull-left col-xs-7 margin-top-10"><?=$value->functionName?></a >
                <?php
                    }
                ?>   
            </div>
        </form>
    </div>
</div>
<div class="col-xs-9">
    <div class="col-xs-12 padding-5 margin-top-10" style="background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12"><span class="pull-right">最后修改者: root -- <?=$apiInfo->lastTime?></span></div>
        <div class="col-xs-12"><h4><b><?=$apiInfo->apiName?></b>-------编号: <span class="cl-red"><?=$apiInfo->number?></span></h4> </div>
        <div class="col-xs-12 margin-top-10">
            <span style="padding:2px;"><b><?=$apiInfo->type?></b></span>--
            <span style="padding:2px;"><?=$apiInfo->project->projectHost?><?=$apiInfo->functionName?></span>
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
                    $params=unserialize($apiInfo->params);
                    $pnum = count($params['name']);
                    for( $i=0; $i<$pnum; $i++ ) {
                ?>
                <tr>
                    <td><?=$params['name'][$i]?></td>
                    <td><?=$params['paramType'][$i]?></td>
                    <td><?=$params['type'][$i]?></td>
                    <td><?=$params['default'][$i]?></td>
                    <td><?=$params['des'][$i]?></td>
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
    <div class="col-xs-12 padding-5" style="margin:50px 0 0 0;background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12 margin-top-10"><button class="btn btn-primary">测试接口</button></div>
        <div class="col-xs-12 margin-top-10">
            <textarea class="form-control" style="min-height: 500px">
                
            </textarea>
        </div>
    </div>
</div>
