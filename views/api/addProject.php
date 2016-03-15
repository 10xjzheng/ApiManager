<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '新建项目';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php include('_searchProject.php');?>
<div class="col-xs-9">
    <h4>新建项目</h4>
    <?php $form = ActiveForm::begin([
        'id' => 'add-project-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-xs-12\">{input}</div>\n<div class=\"col-xs-12\">{error}</div>",
            
        ],
    ]); 
    echo $form->field($model, 'projectName', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('工程名称'),
    ],
    ])->label(false);
    echo $form->field($model, 'projectHost', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('接口前缀'),
    ],
    ])->label(false);
    echo $form->field($model, 'discribe', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('描述'),
    ],
    ])->label(false);
    ?>
    <div class="form-group">
        <div class="col-xs-12">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary pull-left', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
