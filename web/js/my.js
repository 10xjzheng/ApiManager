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
 
$(document).on("click",".delete-tr",function() {
    var lineNum=$(this).parents('tr').closest('tr').index();
    $("#r"+lineNum).parent().remove(); 
    $(this).parent().parent().remove();
});
function addRow(tableId) {
    var parent=0;
    if(tableId=='r') parent=1;
    var html ='<tr>' +
        '<td class="form-group has-error" ><input name="r[tableName][]" type="hidden" value="'+tableId+'" /><input name="r[parent][]" type="hidden" value="'+parent+'" /><input type="text" class="form-control has-error" name="r[name][]" placeholder="参数名" required="required"></td>' +
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
$(document).on("change",".return-array",function() {
    var lineNum=$(this).parents('tr').closest('tr').index();
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
// $(window).bind('beforeunload',function(){return '您输入的内容尚未保存!';});