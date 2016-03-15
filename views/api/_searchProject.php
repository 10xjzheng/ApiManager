<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\bootstrap\Dropdown;
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