var p_stage_id;

function add_levels(x){
    p_stage_id=x;
    $.get(js_var_object.current_link,
        {
            action:"get_data_l",
             stage_id:x
        }, function (result) {
            $('#datagrid_2').datagrid("reload",{
                action:"get_data_l",
                stage_id:x
            });
        }, 'json'
    );


    $("#second_model").dialog("open");
}
function add_edit_s(action) {

    $('.loading-indicator').show();


    $.post(js_var_object.current_link,
        {
            action:action,
            stage_name:$('#stage_name').val(),
            id:$('#kid_s').val()
        }, function (result) {
            if (result.result == "success") {
                toastr.success('  Success  ');//Success Info Warning Error

                $('.loading-indicator').hide();
                $("#mymodal").dialog("close");
            } else {
                toastr.error('Failed   ');//Success Info Warning Error

            }

            $('#datagrid').datagrid("reload");
        }, 'json'
    );


}
function add_edit_l(action) {

    $('.loading-indicator').show();
    $.post(js_var_object.current_link,
        {
            action:action,
            stage_id:p_stage_id,
            level_name:$('#level_name').val(),
            id_l:$('#level_id').val()
        }, function (result) {
            if (result.result == "success") {
                toastr.success('  Success  ');//Success Info Warning Error

                $('.loading-indicator').hide();
                $("#level_dialog").dialog("close");
            } else {
                toastr.error('Failed   ');//Success Info Warning Error

            }

            $('#datagrid_2').datagrid("reload");
        }, 'json'
    );


}
function _delete_s(index,id) {
    $('#datagrid').datagrid('selectRow', index);
    bootbox.confirm('Are you sure you want to delete this Record ? ', function (yes) {
            if (yes) {
                $('.bootbox-close-button.close').trigger("click");
                   $('#datagrid').datagrid('deleteRow', index);

                    $.post(
                        js_var_object.current_link,
                        {
                            action:'delete_s',
                           id:''+id

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
function edit_dialog_s(index) {
    $('#datagrid').datagrid('selectRow', index);
    var selection = $('#datagrid').datagrid('getSelected');
    $('#stage_name').val(selection.stage_name);
    $('#kid_s').val(selection.stage_id);
    $('#submit_add_s').hide();
    $('#submit_edit_s').show();
    $("#mymodal").dialog("open");
}
function _delete_l(index,id) {
    $('#datagrid_2').datagrid('selectRow', index);
    bootbox.confirm('Are you sure you want to delete this Record ? ', function (yes) {
            if (yes) {
                $('.bootbox-close-button.close').trigger("click");
                $('#datagrid_2').datagrid('deleteRow', index);

                $.post(
                    js_var_object.current_link,
                    {
                        action:'delete_l',
                        stage_id:p_stage_id,
                        level_id:id

                    }, function (result) {
                        if (result.result == "success") {
                            toastr.success('successfully procedure ');//Success Info Warning Error

                        } else {
                            toastr.error('Failed procedure ');//Success Info Warning Error
                        }

                        $('#datagrid_2').datagrid("reload");
                    }, 'json'
                );


                return false;

            }
        }
    );
}
function edit_dialog_l(index) {
    $('#datagrid_2').datagrid('selectRow', index);
    var selections = $('#datagrid_2').datagrid('getSelected');
    $('#level_name').val(selections.level_name);
    $('#level_id').val(selections.level_id);
    $('#submit_add_l').hide();
    $('#submit_edit_l').show();

    $('#level_id').attr("disabled","disabled");

    $("#level_dialog").dialog("open");
}
$(function () {

    $("#mymodal,#second_model,#level_dialog").dialog({
        width:530,
        top:100,
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
        $('#submit_add_s').show();
        $('#submit_edit_s').hide();
        $("#mymodal").dialog("open");
    });

    $('#cancel_s').click(function () {
        $("#mymodal").dialog("close");
    });


    $('#submit_add_s').click(function () {
        add_edit_s("add_s");
    });
    $('#submit_edit_s').click(function () {
        add_edit_s("edit_s");
    });

    $('#cancel_l').click(function () {
        $("#level_dialog").dialog("close");
    });


    $('#submit_add_l').click(function () {
        add_edit_l("add_l");
    });
    $('#submit_edit_l').click(function () {
        add_edit_l("edit_l");
    });

    $('#open_new_dialog_2').click(function () {
        $('#reset_btn_l').trigger("click");
        $('#submit_add_l').show();
        $('#submit_edit_l').hide();
        $("#level_dialog").dialog("open");
        $('#level_id').removeAttr("disabled");
    });


    $('#datagrid').datagrid({
        url:js_var_object.current_link,
        singleSelect:true,
        rownumbers:false,
        pagination:true,
        sortName:'released',
        sortOrder:'desc',
        width:720,
        fixed:true,
        queryParams:{
            action:'get_data_s',
            user_group:$("#select_group").val()
        },
        method:'get',
        pageSize:20,
        autoRowHeight:true,
        rowStyler:function (index, row) {

            return 'height:35px;  border:2px solid #000';

        }, columns:[
            [
                {field:'action', title:'#', type:'label', width:100, align:'center',
                    formatter:function (value, row, index) {


                            var e = '<a href="javascript:void(0);" onclick="edit_dialog_s(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                            var d = '<a href="javascript:void(0);" onclick="_delete_s('+index +','+row.stage_id+')"><i class="icon-trash bigger-130"></i></a>';

                            return "<div>" + e + d + "</div>";
                    }

                },
                // {field:'id', title:"Id", width:60, align:'center', sortable:true},


                {field:'stage_name', title:"Name", width:400, align:'center', sortable:true,
                    editor:{
                        type:'text'
                    }
                },


                {field:'Levels', align:'center', title:"Levels", width:200, sortable:true,

                    formatter:function (value, row, index) {
                    return '<a href="javascript:void(0);" onclick="add_levels('+row.stage_id+');" > Add Levels</a>';
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

    $('#datagrid_2').datagrid({
        url:js_var_object.current_link,
        singleSelect:true,
        rownumbers:false,
        pagination:true,
        sortName:'released',
        sortOrder:'desc',
        width:500,
        fixed:true,
        queryParams:{
            action:'get_data_s',
            user_group:$("#select_group").val()
        },
        method:'get',
        pageSize:20,
        autoRowHeight:true,
        rowStyler:function (index, row) {

            return 'height:35px;  border:2px solid #000';

        }, columns:[
            [
                {field:'action', title:'#', type:'label', width:100, align:'center',
                    formatter:function (value, row, index) {


                            var e = '<a href="javascript:void(0);" onclick="edit_dialog_l(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                            var d = '<a href="javascript:void(0);" onclick="_delete_l('+index +','+row.level_id+')"><i class="icon-trash bigger-130"></i></a>';

                            return "<div>" + e + d + "</div>";
                    }

                },
                {field:'level_id', title:"Id", width:60, align:'center', sortable:true},


                {field:'level_name', title:"Name", width:300, align:'center', sortable:true,
                    editor:{
                        type:'text'
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


