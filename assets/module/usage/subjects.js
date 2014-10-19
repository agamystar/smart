
function getRowIndex(target) {
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}
function add_edit(action) {
    $('#username').removeAttr("disabled");
    $('#password').removeAttr("disabled");

    $('.loading-indicator').show();


    $.post(js_var_object.current_link,
        {
            action:action,
            stage_id:$('#stage_id').val(),
            subject_name:$('#subject_name').val(),
            subject_id:$('#kid').val()

        }, function (result) {
            if (result.result == "success") {
                toastr.success('  Success  ');//Success Info Warning Error

                $('.loading-indicator').hide();
                $("#mymodal").dialog("close");
            }
            else {
                toastr.error('Failed   ');//Success Info Warning Error

            }

            $('#datagrid').datagrid("reload");
        }, 'json'
    );


}
function editrow(target) {
    $('#datagrid').datagrid('selectRow', target);
    $('#datagrid').datagrid('beginEdit', target);

    return false;
}
function _delete(index,id) {
    $('#datagrid').datagrid('selectRow', index);
    bootbox.confirm('Are you sure you want to delete this Record ? ', function (result) {
            if (result) {
                $('.bootbox-close-button.close').trigger("click");
                $('#datagrid').datagrid('deleteRow', index);

                $.post(
                    js_var_object.current_link,
                    {
                        action:'delete',
                        subject_id:''+id

                    }, function (result) {
                        if (result.result == "success") {
                            toastr.success('successfully procedure ');//Success Info Warning Error

                        } else {
                            toastr.error('Failed procedure ');//Success Info Warning Error
                        }

                        $('#datagrid').datagrid("reload");
                    }, 'json'
                );


                return false;

            }
        }
    );
}
function edit_dialog(index) {
    $('#datagrid').datagrid('selectRow', index);
    var selection = $('#datagrid').datagrid('getSelected');
    $('#stage_id').val(selection.stage_id);
    $('#subject_name').val(selection.name);
    $('#kid').val(selection.subject_id);
    $('#submit_add').hide();
    $('#submit_edit').show();
    $("#mymodal").dialog("open");
}

$(function () {

    var list_stages=[];
    $.each(js_var_object.stages,function(x,y){
        list_stages[y.stage_id]= y.stage_name;
    });


    $("#mymodal").dialog({
        width:550,
        height:250,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true,
        modal:true,
        closed:true,
        title:'   '
    });



    $('#open_new_dialog').click(function () {
        $('#reset_btn').trigger("click");
        $('div#password_section').show();
        $('div#r_password_section').show();
        $('#submit_add').show();
        $('#submit_edit').hide();
        $("#mymodal").dialog("open");
    });
    $('#cancel').click(function () {
        $("#mymodal").dialog("close");
    });


    $('#submit_add').click(function () {
        add_edit("add");
    });
    $('#submit_edit').click(function () {
        add_edit("edit");
    });


    $('#datagrid').datagrid({
        url:js_var_object.current_link,
        singleSelect:true,
        rownumbers:false,
        pagination:true,
        sortName:'released',
        sortOrder:'desc',
        width:600,
        fixed:true,
        queryParams:{
            action:'get_data',
            user_group:$("#select_group").val()
        },
        method:'get',
        pageSize:20,
        autoRowHeight:true,
        rowStyler:function (index, row) {

            return 'height:35px;  border:2px solid #000';

        }, columns:[
            [
                {field:'action', title:'#', type:'label', width:40, align:'center',
                    formatter:function (value, row, index) {


                        var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                        var d = '<a href="javascript:void(0);" onclick="_delete('+index +',\''+row.subject_id+'\')"><i class="icon-trash bigger-130"></i></a>';
                        var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')" ></a>';
                        return "<div>" + e + d + "</div>";
                    }

                },
                // {field:'id', title:"Id", width:60, align:'center', sortable:true},

                {field:'name', title:"Name", width:300, align:'center', sortable:true},
                {field:'stage_id', title:"Stage", width:230, align:'center', sortable:true,
                    formatter:function(value,row,index){
                        return list_stages[value];
                    }
                }





            ]
        ],
        onBeforeLoad:function (param) {
        },
        onLoadSuccess:function (data) {

            $('#import_text').text("Import  " + $('#select_group option:selected').text());
            $('#export_text').text("Export  " + $('#select_group option:selected').text());

        }, onDblClickRow:function (rowIndex, rowData) {

        }, onSelect:function (rowIndex, rowData) {

        },
        onBeforeEdit:function (index, row) {
            row.editing = true;
            updateActions(index);
        },
        onAfterEdit:function (index, row) {
            row.editing = false;
            updateActions(index);
        },
        onCancelEdit:function (index, row) {
            row.editing = false;
            updateActions(index);
        }
    });



});


