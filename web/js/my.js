function add(){
    var $html ='<tr>' +
        '<td class="form-group has-error" ><input type="text" class="form-control has-error" name="p[name][]" placeholder="参数名" required="required"></td>' +
        '<td class="form-group has-error">' +
        '<select class="form-control" name="p[paramType][]" ><option value="1">string</option><option value="2">int</option><option value="3">float</option><option value="4">array</option></select></td>' +
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
        '<button type="button" class="btn btn-danger" onclick="del(this)">删除</button>' +
        '</td>' +
        '</tr >';
    $('#parameter').append($html);
}
 
function del (obj) {
    $(obj).parents('tr').remove();
}

function addReturnParams(){
    var $html ='<tr>' +
        '<td class="form-group has-error" ><input type="text" class="form-control has-error" name="p[name][]" placeholder="参数名" required="required"></td>' +
        '<td class="form-group has-error">' +
        '<select class="form-control" name="p[paramType][]" ><option value="1">string</option><option value="2">int</option><option value="3">float</option><option value="4">array</option></select></td>' +
        '<td>' +
        '<textarea name="p[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"></textarea>' +
        '</td>' +
        '<td>' +
        '<button type="button" class="btn btn-danger" onclick="del(this)">删除</button>' +
        '</td>' +
        '</tr >';
    $('#returnParameter').append($html);
}
$(document).on("change",".return-array",function() {
    if($(this).val()==4){
        $(this).parents('tr').after('<tr><td colspan="3">\
            <table class="table">\
                <thead>\
                <tr>\
                    <th class="col-md-3">参数名</th>\
                    <th class="col-md-2">参数类型</th>\
                    <th class="col-md-4">描述</th>\
                    <th class="col-md-1">\
                        <button type="button" class="btn btn-success" onclick="addReturnParams()">新增</button>\
                    </th>\
                </tr>\
                </thead>\
                <tbody id="returnParameter">\
                <tr>\
                    <td class="form-group has-error">\
                        <input type="text" class="form-control" name="p[name][]" placeholder="参数名" required="required">\
                    </td>\
                    <td class="form-group has-error return-array">\
                         <select class="form-control" name="p[paramType][]">\
                            <option value="1">string</option>\
                            <option value="2">int</option>\
                            <option value="3">float</option>\
                            <option value="4">array</option>\
                        </select>\
                    </td>\
                    <td><textarea name="p[des][]" rows="1" class="form-control" style="height: 34px;" placeholder="描述"></textarea></td>\
                    <td><button type="button" class="btn btn-danger" onclick="del(this)">删除</button></td>\
                </tr>\
                </tbody>\
            </table>\
            </td></tr>');
    }
});