function undo() {
    $('#datagrid').datagrid('reload');
}
function cancelrow(target) {
    var editors = $('#datagrid').datagrid('getEditors', target);
    if (editors[0] != undefined) {
        if (editors[0].target.val().length > 0 || editors[1].target.val().length > 0) {

        } else {
            $('#datagrid').datagrid('deleteRow', target);
        }
    }
    $('#datagrid').datagrid('cancelEdit', target);
    return false;
}
function start_edit(id) {
    $('#datagrid').datagrid('beginEdit', id);
}
function updateActions(index) {
    $('#datagrid').datagrid('updateRow', {
        index:index,
        row:{}
    });
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
        no:$('#bus_no').val(),
        driver:$('#driver').val(),
        supervisor:$('#supervisor').val(),
        path:$('#path').val(),
        student_fees:$('#student_fees').val(),
        school_fees:$('#school_fees').val(),
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
    bootbox.confirm('Are you sure you want to delete this Record ? ', function (yes) {
            if (yes) {
                   $('#datagrid').datagrid('deleteRow', index);

                    $.post(
                        js_var_object.current_link,
                        {
                            action:'delete',
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
function edit_dialog(index) {
    $('#datagrid').datagrid('selectRow', index);
    var selection = $('#datagrid').datagrid('getSelected');
    $('#bus_no').val(selection.no);
    $('#driver').val(selection.driver);
    $('#supervisor').val(selection.supervisor);
    $('#path').val(selection.path);
    $('#student_fees').val(selection.student_fees);
    $('#school_fees').val(selection.school_fees);
    $('#kid').val(selection.no);
    $('#submit_add').hide();
    $('#submit_edit').show();
    $("#mymodal").dialog("open");
}

$(function () {

    $("#mymodal").dialog({
        width:550,
        autoOpen:false,
        modal:true,
        closed:true,
        title:' Bus  '
    });


    $("#import_dialog").dialog({
        width:500,
        autoOpen:false,
        modal:true,
        closed:true,
        title:'Import Form'
    });

    $("#export_dialog").dialog({
        width:500,
        autoOpen:false,
        modal:true,
        closed:true,

        title:'Export Form'
    });


    $('#export').click(function () {


        location.href = js_var_object.current_link + "/export/" + $('#select_group').val();


    });

    $('#import').click(function () {

        $("#import_dialog").dialog("open");


    });


    $('#import_form').submit(function (e) {
        $.ajax({
            url:js_var_object.current_link + "/import/" + $('#select_group').val(),
            beforeSend:function () {
                $('#import_form').addClass('active');
                $('.loading-indicator').show();
            },
            complete:function (result) {

            }, success:function (result) {
                $('#import_form').removeClass('active');
                var res = JSON.stringify(result);
                //  alert(res);
                $('.loading-indicator').hide();
                toastr.success('data inserted successfully procedure ', result.rows);
                $('#datagrid').datagrid('reload');

            },
            type:'POST',
            data:new FormData(this),
            processData:false,
            contentType:false
        });
        e.preventDefault();
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
        width:1120,
        fixed:true,
        queryParams:{
            action:'get_data',
            user_group:$("#select_group").val()
        },
        method:'get',
        pageSize:10,
        autoRowHeight:true,
        rowStyler:function (index, row) {

            return 'height:35px;  border:2px solid #000';

        }, columns:[
            [
                {field:'action', title:'#', type:'label', width:40, align:'center',
                    formatter:function (value, row, index) {


                            var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><img src="./assets/img/edit.pn" alt=""/><i class="icon-pencil bigger-130"></i></a> ';
                            var d = '<a href="javascript:void(0);" onclick="_delete('+index +',\''+row.no+'\')"><img src="./assets/img/delete.pn" alt=""/><i class="icon-trash bigger-130"></i></a>';
                            var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')" ><img src="./assets/img/view.png" alt="view"/></a>';
                            return "<div>" + e + d + "</div>";
                    }

                },
                // {field:'id', title:"Id", width:60, align:'center', sortable:true},

                {field:'no', title:"No", width:100, align:'center', sortable:true,
                    editor:{
                        type:'text'
                    }
                },
                {field:'driver', title:"Driver", width:200, align:'center', sortable:true,
                    editor:{
                        type:'text'
                    }
                },


                {field:'supervisor', align:'center', title:"Supervisor", width:200, sortable:true,
                    editor:{
                        type:'text'

                    }},
                {field:'path', align:'center', title:"Path", width:300, sortable:true,
                    editor:{
                        type:'text'

                    }},

                {field:'student_fees', align:'center', title:"Student Fees", width:100, sortable:true,
                    editor:{
                        type:'text'

                    }
                },
                {field:'school_fees', align:'center', title:"School Fees", width:100, sortable:true,
                    editor:{
                        type:'text'

                    }}

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

    $('input#active_0').on('click', function () {
        alert("ok");
    });


});


