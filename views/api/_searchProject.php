<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\bootstrap\Dropdown;
use yii\widgets\ListView;
?>
<div class="col-xs-3 main-left margin-left-0 pull-left padding-5">
    <div>
        <div style="margin:20px 0 0 0;">
            <div><input type="text" value=""  onkeyup="search($(this).val(),2)"  class="form-control"  placeholder="Search..."></div>
            <?= Html::a('新建项目', ['api/add-project'], ['class' => 'btn btn-success pull-right margin-top-10']) ?>
            <div id="project-list">
                <?php
                    foreach ($data as $key => $value) {
                ?>    
                    <a href= "<?= Url::to([ 'api/api-info', 'id'=>$value->projectId,'apiId'=>0]); ?>" class="pull-left col-xs-7 margin-top-10">
                    <span class="glyphicon glyphicon-file"></span>&nbsp;<?=$value->projectName?>
                    </a >
                <?php
                    }
                ?>   
            </div>  
            
        </div>
    </div>
</div>