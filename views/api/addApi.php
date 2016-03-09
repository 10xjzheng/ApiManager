<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '新建接口';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h4>新建项目</h4>
    <?php $form = ActiveForm::begin([
        'id' => 'add-project-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-xs-12\">{input}</div>\n<div class=\"col-xs-12\">{error}</div>",
            
        ],
    ]); 
    ?>
    <?= $form->field($model, 'apiNum',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">接口编号</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('接口编号'),],])->label(false)->textInput(['autofocus' => true]) ?>
     <?= $form->field($model, 'apiName',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">接口名称</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('接口名称'),],])->label(false)->textInput(['autofocus' => true]) ?>
     <?= $form->field($model, 'apiUrl',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">请求地址</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('请求地址'),],])->label(false)->textInput(['autofocus' => true]) ?>
     <?=$form->field($model, 'type')->label(false)->dropDownList(['1'=>'GET','2'=>'POST'], ['class'=>'col-xs-12 form-control']) ?>
    <div class="col-xs-12 form-group">
        <h4>请求参数</h4>
        <table class="table">
            <thead>
            <tr>
                <th class="col-md-3">参数名</th>
                <th class="col-md-2">参数类型</th>
                <th class="col-md-2">必传</th>
                <th class="col-md-2">缺省值</th>
                <th class="col-md-4">描述</th>
                <th class="col-md-1">
                    <button type="button" class="btn btn-success" onclick="add()">新增</button>
                </th>
            </tr>
            </thead>
            <tbody id="parameter">
            <tr>
                <td class="form-group has-error">
                    <input type="text" class="form-control" name="p[name][]" placeholder="参数名" required="required">
                </td>
                <td class="form-group has-error">
                    <select class="form-control" name="p[paramType][]">
                        <option value="1">string</option>
                        <option value="2">int</option>
                        <option value="3">float</option>
                        <option value="4">array</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="p[type][]">
                        <option value="Y">Y</option>
                        <option value="N">N</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="p[default][]" placeholder="缺省值"></td>
                <td><textarea name="p[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"></textarea></td>
                <td><button type="button" class="btn btn-danger" onclick="del(this)">删除</button></td>
            </tr>
            </tbody>
        </table>
    </div>
     <div class="col-xs-12 form-group" style="margin-top:50px">
        <h4>返回参数</h4>
        <table class="table">
            <thead>
            <tr>
                <th class="col-md-3">参数名</th>
                <th class="col-md-2">参数类型</th>
                <th class="col-md-4">描述</th>
                <th class="col-md-1">
                    <button type="button" class="btn btn-success" onclick="addReturnParams()">新增</button>
                </th>
            </tr>
            </thead>
            <tbody id="returnParameter">
            <tr>
                <td class="form-group has-error">
                    <input type="text" class="form-control" name="p[name][]" placeholder="参数名" required="required">
                </td>
                <td class="form-group has-error">
                     <select class="form-control return-array" name="p[paramType][]">
                        <option value="1">string</option>
                        <option value="2">int</option>
                        <option value="3">float</option>
                        <option value="4">array</option>
                    </select>
                </td>
                <td><textarea name="p[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"></textarea></td>
                <td><button type="button" class="btn btn-danger" onclick="del(this)">删除</button></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div></div>
    <div class="form-group">
        <div class="col-xs-12">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary pull-left', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
