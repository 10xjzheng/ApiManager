<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '接口信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-12">
    <div class="col-xs-12 padding-5" style="background-color: #d9edf7;border-color:#bce8f1;color:#31708f">
        <div class="col-xs-12"><span class="pull-right">最后修改者: root  2016-03-02 18:00:16</span></div>
        <div class="col-xs-12"><h4><b>用户登录</b>-------编号: <span class="cl-red">001</span></h4> </div>
        <div class="col-xs-12 magin-top-10">
            <span style="background-color:#3385ff;padding:2px;color:white"><b>POST</b></span>-
            <span style="background-color:#3385ff;padding:2px;color:white">http://bannong.ibona.cn/index.php//admin/Interface/ ThirdPartLogin</span>
        </div>
        <div class="col-xs-12 magin-top-10" ><b>描述</b>：用户的第三方登录，包括微信，qq</div>
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
    <div class="col-xs-12 magin-top-10"><button class="btn btn-primary">测试接口</button></div>
    <div class="col-xs-12 magin-top-10">
        <textarea class="form-control" style="min-height: 500px">
            
        </textarea>
    </div>
</div>
