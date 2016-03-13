<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\widgets\ListView;
?>
<div class="col-xs-3 main-left margin-left-0 pull-left padding-5">
    <div>
        <form action="" method="post">
            <div style="margin:20px 0 0 0;">
                <div><input type="text" value="" class="form-control"  placeholder="Search..."></div>
                <?= Html::a('新建项目', ['api/add-project'], ['class' => 'btn btn-success pull-right margin-top-10']) ?>
                <div>
                    <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => '',
                    'summaryOptions' => ['tag' => 'p', 'class' => 'text-right text-info'],
                    'emptyTextOptions' => ['class' => 'callout callout-warning'],
                    'emptyText' => '您还没有创建项目。',
                    'itemView' => '_item',//子视图 
                ]) ?>
                </div>  
                
            </div>
        </form>
    </div>
</div>
<div class="col-xs-9 margin-left-0 pull-left padding-0">
    <div style="font-size:18px;">
        <div class="info" style="font-size:14px;">
            <span style="font-size:30px;" class="glyphicon glyphicon-grain" aria-hidden="true"></span> <span style="font-size:16px;">欢迎使用接口管理工具 </span><br>
            <pre class="info" style="margin:10px 34px 10px 34px">
    什么是接口文档管理工具?
    &nbsp;&nbsp;&nbsp;&nbsp;是一个在线API文档系统；其致力于快速解决团队内部接口文档的编写、维护、存档，和减少团队协作开发的沟通成本。
            </pre>
        </div>
        <!-- <div style="font-size:12px;position:absolute;bottom:0;right:20px;height:20px;text-align:right;">
            路人庚 | qq : 309581329 | github : <a target="_blank" href="https://github.com/gongwalker/ApiManager.git">https://github.com/gongwalker/ApiManager.git</a>
        </div> -->
    </div>
</div>