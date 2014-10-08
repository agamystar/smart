var expenses_id="";
function show_installments(ex_id) {

    expenses_id=ex_id;
    $("#dg2_container").dialog("open");

    $('#datagrid_2').datagrid({
        url:js_var_object.current_link,
        singleSelect:true,
        rownumbers:false,
        pagination:true,
        sortName:'released',
        sortOrder:'desc',
        width:530,
        height:420,
        fixed:true,
        queryParams:{
            action:'get_data_2',
            expenses_id:ex_id
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


                        var e = '<a href="javascript:void(0);" onclick="edit_dialog_2(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                        var d = '<a href="javascript:void(0);" onclick="_delete_2(' + index + ',' + row.installment_id + ')"><i class="icon-trash bigger-130"></i></a>';
                        var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')" ></a>';
                        return "<div>" + e + d + "</div>";
                    }

                },
                // {field:'id', title:"Id", width:60, align:'center', sortable:true},

                {field:'name', title:"Name", width:200, align:'center', sortable:true},
                {field:'value', title:"Value", width:100, align:'center', sortable:true},
                {field:'end_date', title:"End Date", width:180, align:'center', sortable:true}

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
    })

        .datagrid('enableFilter', [

        {
            field:'id',
            type:'text',
            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'name',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'birthday',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'email',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        }
        ,
        {
            field:'phone',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'address',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'sex',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'religion',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        }


    ]);
}

function getRowIndex(target) {
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}
function add_edit(action) {
    $('#username').removeAttr("disabled");
    $('#password').removeAttr("disabled");

    $('.loading-indicator').show();
    var addnewrow = {
        name:$('#name').val(),
        stage:$('#stage').val(),
        level:$('#level').val(),
        value:$('#value').val(),
        id:$('#kid').val()
    };


    $.post(js_var_object.current_link,
        {
            action:action,
            row_add:JSON.stringify(addnewrow)
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
function add_edit_2(action) {
    $('.loading-indicator').show();

    var addnewrow = {

        expenses_id:expenses_id,
        name:$('#name_2').val(),
        value:$('#value_2').val(),
        end_date:$('#end_date_2').datebox("getValue"),
        installment_id:$('#kid_2').val()
    };


    $.post(js_var_object.current_link,
        {
            action:action,
            row_add:JSON.stringify(addnewrow)
        }, function (result) {
            if (result.result == "success") {
                toastr.success('  Success  ');//Success Info Warning Error

                $('.loading-indicator').hide();
                $("#mymodal_2").dialog("close");
            } else {
                toastr.error('Failed   ');//Success Info Warning Error

            }

            $('#datagrid_2').datagrid("reload");
        }, 'json'
    );


}
function editrow(target) {
    $('#datagrid').datagrid('selectRow', target);
    $('#datagrid').datagrid('beginEdit', target);

    return false;
}
function _delete_1(index, id) {
    $('#datagrid').datagrid('selectRow', index);
    bootbox.confirm('Are you sure you want to delete this Record ? ', function (yes) {
            if (yes) {
                $('.bootbox-close-button.close').trigger("click");
                $('#datagrid').datagrid('deleteRow', index);

                $.post(
                    js_var_object.current_link,
                    {
                        action:'delete_1',
                        id:'' + id

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
function _delete_2(index, id) {
    $('#datagrid').datagrid('selectRow', index);
    bootbox.confirm('Are you sure you want to delete this Record ? ', function (yes) {
            if (yes) {
                $('.bootbox-close-button.close').trigger("click");
                $('#datagrid_2').datagrid('deleteRow', index);

                $.post(
                    js_var_object.current_link,
                    {
                        action:'delete_2',
                        id:'' + id

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
function edit_dialog(index) {
    $('#datagrid').datagrid('selectRow', index);
    var selection = $('#datagrid').datagrid('getSelected');
    $('#name').val(selection.expenses_name);
    $('#stage').val(selection.expenses_stage);
    $('#level').val(selection.expenses_level);
    $('#value').val(selection.expenses_value);
    $('#kid').val(selection.expenses_id);
    $('#submit_add').hide();
    $('#submit_edit').show();
    $("#mymodal").dialog("open");
}
function edit_dialog_2(index) {
    $('#datagrid_2').datagrid('selectRow', index);
    var selection = $('#datagrid_2').datagrid('getSelected');
    $('#name_2').val(selection.name);
    $('#value_2').val(selection.value);
    $('#end_date_2').datebox("setValue",selection.end_date);
    $('#kid_2').val(selection.installment_id);
    $('#submit_add_2').hide();
    $('#submit_edit_2').show();
    $("#mymodal_2").dialog("open");
}

$(function () {

    $('.date').datebox({
        height:30,
        width:300
    });
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();

    var output = (day < 10 ? '0' : '') + day + '/' +
        (month < 10 ? '0' : '') + month + '/' +
        d.getFullYear();

    $('.date').datebox("setValue", output);


    var list_stages = [];
    $.each(js_var_object.stages, function (x, y) {
        list_stages[y.stage_id] = y.stage_name;
    });

    var list_levels = [];
    $.each(js_var_object.levels, function (x, y) {
        list_levels[y.level_id] = y.level_name;
    });

    var options = "";
    $.each(js_var_object.stages, function (x, y) {

        options += "<option value=" + y.stage_id + ">" + y.stage_name + "</option>";
    });

    $('select#stage').html(options);


    $('select#stage').change(function () {
        // alert($(this).val());
        var options = '';
        var stage = $(this).val();

        var result = $.grep(js_var_object.levels, function (x) {
                return   x.stage_id === stage;
            }
        );


        $.each(result, function (x, y) {

            options += "<option value=" + y.level_id + ">" + y.level_name + "</option>";
        });
        ///  alert(options);
        $('select#level').html(options)
    });


    $('select#stage').trigger("change");


    $("#mymodal").dialog({
        width:550,
        height:350,
        modal:true,
        closed:true,
        title:'   ',
        cache:false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
    });


    $("#mymodal_2").dialog({
        width:550,
        height:300,
        modal:true,
        closed:true,
        title:'   ',
        cache:false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
    });


    $("#dg2_container").dialog({
        width:550,
        height:480,
        modal:true,
        closed:true,
        title:'   ',
        cache:false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
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

    $('#open_new_dialog_2').click(function () {
        $('#reset_btn_2').trigger("click");
        $('#submit_add_2').show();
        $('#submit_edit_2').hide();
        $("#mymodal_2").dialog("open");
    });
    $('#cancel_2').click(function () {
        $("#mymodal_2").dialog("close");
    });


    $('#submit_add').click(function () {
        add_edit("add_1");
    });
    $('#submit_edit').click(function () {
        add_edit("edit_1");
    });

    $('#submit_add_2').click(function () {
        add_edit_2("add_2");
    });
    $('#submit_edit_2').click(function () {
        add_edit_2("edit_2");
    });


    $('#datagrid_2').datagrid();

    $('#datagrid').datagrid({
        url:js_var_object.current_link,
        singleSelect:true,
        rownumbers:false,
        pagination:true,
        sortName:'released',
        sortOrder:'desc',
        width:1120,
        fixed:true,
        queryParams:{
            action:'get_data_1',
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
                        var d = '<a href="javascript:void(0);" onclick="_delete_1(' + index + ',' + row.expenses_id + ')"><i class="icon-trash bigger-130"></i></a>';
                        var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')" ></a>';
                        return "<div>" + e + d + "</div>";
                    }

                },
                // {field:'id', title:"Id", width:60, align:'center', sortable:true},

                {field:'expenses_id', title:" ID ", width:100, align:'center', sortable:true,
                    editor:{
                        type:'text'
                    }
                },
                {field:'expenses_name', title:"Name", width:200, align:'center', sortable:true

                },

                {field:'expenses_level', title:"Level", width:200, align:'center', sortable:true,
                    formatter:function (value, row, index) {
                        return list_levels[value];
                    }
                },

                {field:'expenses_stage', title:"Stage", width:190, align:'center', sortable:true,
                    formatter:function (value, row, index) {
                        return list_stages[value];
                    }},
                {field:'expenses_value', title:"Value", width:110, align:'center', sortable:true

                },

                {field:'expenses_levels', align:'center', title:"Installments", width:200, sortable:true,

                    formatter:function (value, row, index) {
                        return '<a href="#" onclick="show_installments(' + row.expenses_id + ')" > Add Installments</a>';
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
    })

        .datagrid('enableFilter', [

        {
            field:'id',
            type:'text',
            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'name',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'birthday',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'email',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        }
        ,
        {
            field:'phone',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'address',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'sex',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field:'religion',
            type:'text',

            op:['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        }


    ]);


});


