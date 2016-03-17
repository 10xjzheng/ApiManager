<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\bootstrap\Dropdown;
use yii\widgets\ListView;
?>
<div class="col-xs-3 main-left margin-left-0 pull-left padding-5">
    <div>
        <div style="margin:0px 0 0 0;">
            <div><input type="text" value="" onkeyup="search($(this).val(),1)"  class="form-control"  placeholder="Search..."></div>
            <?= Html::a('新建接口', ['api/add-api','id'=>$_GET['id'],'apiId'=>0], ['class' => 'btn btn-success pull-right margin-top-10']) ?>
            <div id="api-list">
            <?php
                foreach ($data as $key => $value) {
            ?>    
                <a href= "<?= Url::to([ 'api/api-info', 'id'=>$_GET['id'],'apiId'=>$value->apiId]); ?>" class="pull-left col-xs-7 margin-top-10"><?=$value->number?>--<?=$value->apiName?></a >
            <?php
                }
            ?>   
            </div>
        </div>
    </div>
</div>