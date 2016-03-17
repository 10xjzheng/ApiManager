// 请求参数添加一行
function add(){
    var $html ='<tr>' +
        '<td class="form-group has-error" ><input type="text" class="form-control has-error" name="p[name][]" placeholder="参数名" required="required"></td>' +
        '<td class="form-group has-error">' +
        '<select class="form-control return-array" name="p[paramType][]" ><option value="string">string</option><option value="int">int</option><option value="float">float</option><option value="array">array</option></select></td>' +
        '<td>' +
        '<select class="form-control" name="p[type][]">' +
        '<option value="Y">Y</option> <option value="N">N</option>' +
        '</select >' +
        '</td>' +
        '<td>' +
        '<input type="text" class="form-control" name="p[default][]" placeholder="缺省值"></td>' +
        '<td>' +
        '<textarea name="p[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"></textarea>' +
        '</td>' +
        '<td>' +
        '<button type="button" class="btn btn-danger delete-tr" >删除</button>' +
        '</td>' +
        '</tr >';
    $('#parameter').append($html);
}
 // 删除行
$(document).on("click",".delete-tr",function() {
    var lineNum=$(this).closest('tr').index();
    console.log(lineNum);
    $("#r"+lineNum).parent().parent().remove(); 
    $(this).parent().parent().remove();
});
// 返回参数的表格添加一行
function addRow(tableId) {
    var parent=0;
    var lineNum=$("#r>tbody>tr").length;
    tableName="r"+lineNum;
    if(tableId=='r'){
        parent=1;
        tableName="r"+lineNum;
    }else tableName=tableId;
    console.log(tableName);
    var html ='<tr>' +
        '<td class="form-group has-error" ><input name="r[tableName][]" type="hidden" value="'+tableName+'" /><input name="r[parent][]" type="hidden" value="'+parent+'" /><input type="text" class="form-control has-error" name="r[name][]" placeholder="参数名" required="required"></td>' +
        '<td class="form-group has-error">' +
        '<select class="form-control return-array" name="r[paramType][]" ><option value="string">string</option><option value="int">int</option><option value="float">float</option><option value="array">array</option></select></td>' +
        '<td class="form-group" ><input type="text" class="form-control" name="r[default][]" placeholder="缺省值" ></td>' +
        '<td>' +
        '<textarea name="r[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"></textarea>' +
        '</td>' +
        '<td>' +
        '<button type="button" class="btn btn-danger delete-tr" >删除</button>' +
        '</td>' +
        '</tr >';
    $("#"+tableId).append(html);
}
// 返回参数为array，添加一个表格
$(document).on("change",".return-array",function() {
    var lineNum=$(this).closest('tr').index();
    console.log(lineNum);
    if($(this).val()=="array"){
        $(this).parents('tr').after('<tr><td colspan="4">\
            <table class="table children-table" id="r'+lineNum+'">\
                <thead>\
                <tr>\
                    <th class="col-md-3">参数名</th>\
                    <th class="col-md-2">参数类型</th>\
                    <th class="col-md-2">缺省值</th>\
                    <th class="col-md-4">描述</th>\
                    <th class="col-md-1">\
                        <button type="button" class="btn btn-success" onclick="addRow(\'r'+lineNum+'\')">新增</button>\
                    </th>\
                </tr>\
                </thead>\
                <tbody>\
                <tr>\
                    <td class="form-group has-error">\
                       <input name="r[tableName][]" type="hidden" value="r'+lineNum+'" /><input name="r[parent][]" type="hidden" value="0" /><input type="text" class="form-control" name="r[name][]" placeholder="参数名" required="required">\
                    </td>\
                    <td class="form-group has-error">\
                         <select class="form-control" name="r[paramType][]">\
                            <option value="string">string</option>\
                            <option value="int">int</option>\
                            <option value="float">float</option>\
                            <option value="array">array</option>\
                        </select>\
                    </td>\
                    <td class="form-group has-error">\
                        <input type="text" class="form-control" name="r[default][]" placeholder="缺省值" >\
                    </td>\
                    <td><textarea name="r[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"></textarea></td>\
                    <td><button type="button" class="btn btn-danger delete-tr" >删除</button></td>\
                </tr>\
                </tbody>\
            </table>\
            </td></tr>');
    }else{
        $("#r"+lineNum).parent().remove(); 
    }
});

function delApi(id,apiId){
    if(confirm("确定要删除此接口？")){
      $.post("?r=api/del",{"apiId":apiId},function(data,textStatus){
            var obj =JSON.parse(data);
            if(obj.code==0){
                location.href="?r=api/api-info&id="+id+"&apiId=0";
            }
            else alert('删除失败');
      });
    }
}
// $(window).bind('beforeunload',function(){return '您输入的内容尚未保存!';});
function format(txt,compress){/* 格式化JSON源码(对象转换为JSON文本) */  
    var indentChar = '    ';   
    if(/^\s*$/.test(txt)){   
        alert('数据为空,无法格式化! ');   
        return;   
    }   
    try{var data=eval('('+txt+')');}   
    catch(e){   
        return txt; 
    };   
    var draw=[],last=false,This=this,line=compress?'':'\n',nodeCount=0,maxDepth=0;   
       
    var notify=function(name,value,isLast,indent/*缩进*/,formObj){   
        nodeCount++;/*节点计数*/  
        for (var i=0,tab='';i<indent;i++ )tab+=indentChar;/* 缩进HTML */  
        tab=compress?'':tab;/*压缩模式忽略缩进*/  
        maxDepth=++indent;/*缩进递增并记录*/  
        if(value&&value.constructor==Array){/*处理数组*/  
            draw.push(tab+(formObj?('"'+name+'":'):'')+'['+line);/*缩进'[' 然后换行*/  
            for (var i=0;i<value.length;i++)   
                notify(i,value[i],i==value.length-1,indent,false);   
            draw.push(tab+']'+(isLast?line:(','+line)));/*缩进']'换行,若非尾元素则添加逗号*/  
        }else   if(value&&typeof value=='object'){/*处理对象*/  
                draw.push(tab+(formObj?('"'+name+'":'):'')+'{'+line);/*缩进'{' 然后换行*/  
                var len=0,i=0;   
                for(var key in value)len++;   
                for(var key in value)notify(key,value[key],++i==len,indent,true);   
                draw.push(tab+'}'+(isLast?line:(','+line)));/*缩进'}'换行,若非尾元素则添加逗号*/  
            }else{   
                    if(typeof value=='string')value='"'+value+'"';   
                    draw.push(tab+(formObj?('"'+name+'":'):'')+value+(isLast?'':',')+line);   
            };   
    };   
    var isLast=true,indent=0;   
    notify('',data,isLast,indent,false);   
    return draw.join('');   
}  
// 测试接口
function TestApi(){
    var map = {}; 
    var text='';
    $("#test-form input").map(function(){ 
        map[$(this).attr("name")]=$(this).val();
        return 0;
    }).get();  
    map.methodType = $("#test-form").attr("method");
    map.url = $("#url").text();
    $.post("?r=api/request",map,function(data,textStatus){
        $("#jsonData").val(format(data,''));
        //alert(data);
    });
}

// 查看logs
$(document).on('click','#readLogs',function(){
    if($(this).hasClass('native')){   
        $(this).removeClass('native');
        $(".glyphicon").attr('class','glyphicon glyphicon-minus');
        $("#logsData").slideDown(600);
    }else{
        $(".glyphicon").attr('class','glyphicon glyphicon-plus');
        $("#logsData").slideUp(600);
        $(this).addClass('native');
    }
});

//
 function search(keywords,type){
    $.post("?r=api/search",{"keywords":keywords,"type":type},function(data,textStatus){
        if(type==1){
            $("#api-list").html('');
            var html="";
            data = JSON.parse(data);
            $.each(eval(data), function(i, item) {  
                html+='<a class="pull-left col-xs-7 margin-top-10" href="?r=api/api-info&id='+item.fkProjectId+'&apiId='+item.apiId+'">'
                +item.number+'--'+item.apiName+'</a>';
            });
            $("#api-list").append(html);
        }else{
            $("#project-list").html('');
            var html="";
            data = JSON.parse(data);
            $.each(eval(data), function(i, item) {  
                html+='<a class="pull-left col-xs-7 margin-top-10" href="?r=api/api-info&id='+item.projectId+'&apiId=0">'
                +'<span class="glyphicon glyphicon-file">'+item.projectName+'</a>';
            });
            $("#project-list").append(html);
        }
    });
}