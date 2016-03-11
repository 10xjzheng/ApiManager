<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '接口信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-3 main-left margin-left-0 pull-left padding-5">
    <div>
        <form action="" method="post">
            <div style="margin:20px 0 0 0;">
                <div><input type="text" value="" class="form-control"  placeholder="Search..."></div>
                <?= Html::a('新建接口', ['api/add-api'], ['class' => 'btn btn-success pull-right margin-top-10 col-xs-5']) ?>
                <?php
                    foreach ($data as $key => $value) {
                        echo '<div class="col-xs-7">'.Html::a($value->functionName, ['api/add-project'], ['class' => 'pull-left margin-top-10']).'</div>';
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
            <span style="background-color:#3385ff;padding:2px;color:white"><b><?=$apiInfo->type?></b></span>-
            <span style="background-color:#3385ff;padding:2px;color:white"><?=$apiInfo->project->projectHost?><?=$apiInfo->functionName?></span>
        </div>
        <div class="col-xs-12 margin-top-10" ><b>描述</b>：<?=$apiInfo->apiDiscribe?></div>
    </div>

    <div class="col-xs-12 padding-5" style="margin:50px 0 0 0;background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12"><h4>请求参数</h4></div>
        <div class="col-xs-12">
            <table class="table">
              <thead>
                <tr><th>参数名</th><th>参数类型</th><th>必传</th><th>缺省值</th><th>描述</th><th>测试值</th></tr>
              </thead>
              <tbody>
                <tr><td>userName</td><td>string</td><td>Y</td><td>null</td><td>用户名</td><td><input class="form-control"  type="text" /></td></tr>
                <tr><td>password</td><td>string</td><td>Y</td><td>null</td><td>用户名</td><td><input class="form-control"  type="text" /></td>
                </tr>
              </tbody>    
            </table>
        </div>
    </div>

    <div class="col-xs-12 padding-5" style="margin:50px 0 0 0;background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12"><h4>返回参数</h4></div>
        <div class="col-xs-12">
            <table class="table">
              <thead>
                <tr><th>参数名</th><th>参数类型</th><th>描述</th></tr>
              </thead>
              <tbody>
                <tr><td>userName</td><td>string</td><td>用户名</td></tr>
                <tr><td>password</td><td>string</td><td>用户名</td></tr>
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
