<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = $projectName;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php include('_searchApi.php');?>
<div class="col-xs-9">
    <h4>新建接口</h4>
    <?php $form = ActiveForm::begin([
        'id' => 'api-form',
        'method'=>"POST",
        'action'=>"?r=api/add-api",
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-xs-12\">{input}</div>\n<div class=\"col-xs-12\">{error}</div>",
            
        ],
    ]); 
    ?>
   <input type="hidden" value="<?=$_GET['apiId']?>" name="apiId" />
   <input type="hidden" value="<?=$_GET['id']?>" name="id" />
    <?= $form->field($model, 'number',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">接口编号</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('接口编号,如：001'),'value'=>$model->number],])->label(false)->textInput(['autofocus' => true]) ?>
     <?= $form->field($model, 'apiName',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">接口名称</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('接口名称,如：用户登录'),'value'=>$model->apiName],])->label(false) ?>
     <?= $form->field($model, 'functionName',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">方法名称</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('方法名称,如：UserLogin'),'value'=>$model->functionName],])->label(false)?>
    <?= $form->field($model, 'apiDiscribe',[
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">接口描述</span>{input}</div>',
    'inputOptions' => ['placeholder' => $model->getAttributeLabel('接口描述,如：实现APP登录，包括第三方登录'),'value'=>$model->apiDiscribe],])->label(false) ?>
     <?php $arr=[0=>['key'=>'GET','value'=>'GET'],1=>['key'=>'POST','value'=>'POST']];$model->type=$model->type;  ?>
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
                $params=unserialize($model->params);
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
        <h5 style="color:red">
        <div>默认返回Json形式统一为：{"appStatus":{"errorCode":1,"message":tips },"content":[]}</div>
        <div> errorCode的值为0表示操作成功，1表示操作失败，message是提示信息，下面配置的是content里需要返回的参数信息。</div>
        </h5> 
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
                $params=unserialize($model->returnParams);
                $pnum = count($params['name']);
                $num=0;
                for( $i=0; $i<$pnum; $i++ ) {
                    if($params['parent'][$i]=="1"){
                        $tableName=$params['tableName'][$i];
            ?>
                        <tr>
                            <td class="form-group has-error" >
                            <input name="r[parent][]" type="hidden" value="<?=$params['parent'][$i]?>" required="required"/>
                            <input name="r[tableName][]" type="hidden" value="<?=$params['tableName'][$i]?>" />
                            <input type="text" class="form-control" name="r[name][]" value="<?=$params['name'][$i]?>" placeholder="参数名" required="required">
                            </td>
                            <td class="form-group has-error" >
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
                            <td><button type="button" class="btn btn-danger delete-tr" >删除</button></td>
                        </tr>
                    <?php
                            }else{
                                if($tableName==$params['tableName'][$i]&&$num==0){
                                    $num++;
                                    echo '<tr><td colspan="4"><table class="table children-table" id="'.$tableName.'"><thead><tr>
                                    <th class="col-md-3">参数名</th>
                                    <th class="col-md-2">参数类型</th>
                                    <th class="col-md-2">缺省值</th>
                                    <th class="col-md-4">描述</th>
                                    <th class="col-md-1">
                                    <button type="button" class="btn btn-success" onclick="addRow(\''.$tableName.'\')">新增</button>
                                    </th></tr></thead><tbody>';

                                }
                                ?>
                                 <tr>
                                    <td class="form-group has-error" >
                                    <input name="r[parent][]" type="hidden" value="<?=$params['parent'][$i]?>" />
                                    <input name="r[tableName][]" type="hidden" value="<?=$params['tableName'][$i]?>" />
                                    <input type="text" class="form-control" name="r[name][]" value="<?=$params['name'][$i]?>" placeholder="参数名" required="required">
                                    </td>
                                    <td class="form-group has-error" >
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
                                    <td><button type="button" class="btn btn-danger delete-tr" >删除</button></td>
                                </tr>
                                <?php
                                if($pnum<=$i+1) echo '</tbody></table></td></tr>';//避免数组越界
                                else if($tableName!=$params['tableName'][$i+1]){
                                    echo '</tbody></table></td></tr>';
                                    $num=0;
                                }
                                ?>
                                
                                
                    <?php
                            }
                        }
                    ?>
            
            </tbody>
        </table>
    </div>
    <div><textarea class="form-control" name="log" required="required" style="min-height:50px" placeholder="日志"></textarea></div>
    <div class="form-group">
        <div class="col-xs-12" style="margin-bottom: 15px;margin-top: 15px;">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary pull-left','onclick'=>'changeValue()','name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
