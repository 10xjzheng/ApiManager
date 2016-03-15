<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\bootstrap\Dropdown;
?>
<div class="api-list col-xs-8">
    <a href= "<?= Url::to([ 'api/api-info', 'id'=>$model->projectId,'apiId'=>0]); ?>" class="pull-left">
    <?=$model->projectName?> <span class="glyphicon glyphicon-chevron-right"></span>
    </a >
</div>