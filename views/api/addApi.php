<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
$this->title = '新建接口';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h4>新建项目</h4>
    <?php $form = ActiveForm::begin([
        'id' => 'add-api-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-xs-12\">{input}</div>\n<div class=\"col-xs-12\">{error}</div>",
            
        ],
    ]); 
    ?>
    <?= $form->field($model, 'number',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">接口编号</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('接口编号'),'value'=>$apiInfo->number],])->label(false)->textInput(['autofocus' => true]) ?>
     <?= $form->field($model, 'apiName',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">接口名称</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('接口名称'),'value'=>$apiInfo->apiName],])->label(false)->textInput(['autofocus' => true]) ?>
     <?= $form->field($model, 'functionName',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">方法名称</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('方法名称'),'value'=>$apiInfo->functionName],])->label(false)->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'apiDiscribe',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">接口描述</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('接口描述'),'value'=>$apiInfo->apiDiscribe],])->label(false)->textInput(['autofocus' => true]) ?>
     <?php $arr=[0=>['key'=>'GET','value'=>'GET'],1=>['key'=>'POST','value'=>'POST']];$model->type=$apiInfo->type;  ?>
     <?=$form->field($model, 'type')->label(false)->dropDownList(ArrayHelper::map($arr, 'key', 'value'), ['class'=>'col-xs-12 form-control']) ?>
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
            <?php
                $params=unserialize($apiInfo->params);
                $pnum = count($params['name']);
                $array0=['string','int','float','array'];
                $array1=['Y','N'];
                for($i=0; $i<$pnum; $i++) { 
                    
            ?>
            <tr>
                <td class="form-group has-error">
                    <input type="text" class="form-control" name="p[name][]" value="<?=$params['name'][$i]?>" placeholder="参数名" required="required">
                </td>
                <td class="form-group has-error">
                    <select class="form-control" name="p[paramType][]">
                        <?php 
                        foreach ($array0 as $key => $value) {
                            if($value==$params['paramType'][$i])
                                echo '<option selected value="'.$value.'">'.$value.'</option>';
                            else 
                                echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                        ?>
                        
                    </select>
                </td>
                <td>
                    <select class="form-control" name="p[type][]">
                        <?php 
                        foreach ($array1 as $key => $value) {
                            if($value==$params['type'][$i])
                                echo '<option selected value="'.$value.'">'.$value.'</option>';
                            else 
                                echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                        ?>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="p[default][]" placeholder="缺省值" value="<?=$params['default'][$i]?>"></td>
                <td><textarea name="p[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"><?=$params['des'][$i]?></textarea></td>
                <td><button type="button" class="btn btn-danger delete-tr" >删除</button></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
     <div class="col-xs-12 form-group" style="margin-top:50px">
        <h4>返回参数</h4>
        <table class="table" id="r">
            <thead>
            <tr>
                <th class="col-md-3">参数名</th>
                <th class="col-md-2">参数类型</th>
                <th class="col-md-2">缺省值</th>
                <th class="col-md-4">描述</th>
                <th class="col-md-1">
                    <button type="button" class="btn btn-success add-params" onclick="addRow('r')">新增</button>
                </th>
            </tr>
            </thead>
            <tbody >
            <?php
                $params=unserialize($apiInfo->returnParams);
                $pnum = count($params['name']);
                for( $i=0; $i<$pnum; $i++ ) {
                    if($params['parent'][$i]=="1"){
            ?>
                    <tr>
                        <td>
                        <input name="r[parent][]" type="hidden" value="<?=$params['parent'][$i]?>" />
                        <input name="r[tableName][]" type="hidden" value="<?=$params['tableName'][$i]?>" />
                        <input type="text" class="form-control" name="r[name][]" value="<?=$params['name'][$i]?>" placeholder="参数名" required="required">
                        </td>
                        <td>
                            <select class="form-control return-array" name="r[paramType][]">
                            <?php
                                foreach ($array0 as $key => $value) {
                                    if($value==$params['paramType'][$i])
                                        echo '<option selected value="'.$value.'">'.$value.'</option>';
                                    else 
                                        echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                            ?>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="r[default][]" placeholder="缺省值" value="<?=$params['default'][$i]?>" ></td>
                        <td><input type="text" class="form-control" name="r[des][]" placeholder="描述" value="<?=$params['des'][$i]?>" ></td>
                    </tr>
                    <?php
                            }else{
                    ?>
                                
                    <?php
                            }
                        }
                    ?>
            <tr>
                <td class="form-group has-error">
                    <input name="r[parent][]" type="hidden" value="1" />
                    <input name="r[tableName][]" type="hidden" value="r0" />
                    <input type="text" class="form-control" name="r[name][]" placeholder="参数名" required="required">
                </td>
                <td class="form-group has-error">
                     <select class="form-control return-array" name="r[paramType][]">
                        <option value="string">string</option>
                        <option value="int">int</option>
                        <option value="float">float</option>
                        <option value="array">array</option>
                    </select>
                </td>
                <td class="form-group">
                    <input type="text" class="form-control" name="r[default][]" placeholder="缺省值" >
                </td>
                <td><textarea name="r[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"></textarea></td>
                <td><button type="button" class="btn btn-danger delete-tr" >删除</button></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div></div>
    <div class="form-group">
        <div class="col-xs-12" style="margin-bottom: 15px;">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary pull-left', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>