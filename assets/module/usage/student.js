

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
function add_edit($action) {
    $('.loading-indicator').show();
    var addnewrow = {
        name:$('#name').val(),
        email:$('#email').val(),
        birthday:$('#birthday').val(),
        address:$('#address').val(),
        phone:$('#phone').val(),
        sex:$('#sex').val(),
        religion:$('#religion').val(),
        class:$('#class').val(),
        roll:$('#roll').val(),
        father_name:$('#father_name').val(),
        mother_name:$('#mother_name').val(),
        id:$('#kid').val()
    }
    $.post(
        js_var_object.current_link,
        {
            action:$action,
            row_add:JSON.stringify(addnewrow)
        }, function (result) {
            if (result.result == "success") {
                toastr.success('successfully procedure ');//Success Info Warning Error

                $('.loading-indicator').hide();
                $("#mymodal").dialog("close");
            } else {
                toastr.error('Failed procedure ');//Success Info Warning Error

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

function _delete(index) {
    $('#datagrid').datagrid('selectRow', index);
    $.messager.confirm("delete", "delete ? ", function (r) {
        if (r) {
            var selection = $('#datagrid').datagrid('getSelected');
            $('#datagrid').datagrid('deleteRow', index);

            $.post(
                js_var_object.current_link,
                {
                    action:'delete',
                    row:JSON.stringify(selection)

                }, function (result) {
                    if (result.result == "success") {
                        toastr.success('successfully procedure ');//Success Info Warning Error

                    } else {
                        toastr.error('Failed procedure ');//Success Info Warning Error
                    }

                    $('#datagrid').datagrid("reload");
                }, 'json'
            );
        }
    });

    return false;
}
function edit_dialog(index) {
    $('#datagrid').datagrid('selectRow', index);
    var selection = $('#datagrid').datagrid('getSelected');
    $('#kid').val(selection.id);
    $('#name').val(selection.name);
    $('#email').val(selection.email);
    $('#birthday').val(selection.birthday);
    $('#address').val(selection.address);
    $('#phone').val(selection.phone);
    $('#sex').val(selection.sex);
    $('#religion').val(selection.religion);
    $('#class').val(selection.class_id);
    $('#roll').val(selection.roll);
    $('#father_name').val(selection.father_name);
    $('#mother_name').val(selection.mother_name);

    $('#submit_add').hide();
    $('#submit_edit').show();

    $("#mymodal").dialog("open");

}

$(function () {

    $("#mymodal").dialog({
        width:900,
        autoOpen:false,
        modal: true,
        closed: true,
        title:'Student Form'
    });
    $("#import_dialog").dialog({
        width:500,
        autoOpen:false,
        modal: true,
        closed: true,
        title:'Import Form'
    });

    $('#import').click(function(){
        $("#import_dialog").dialog("open");
    });

    $( '#export' ).click( function( e ) {

        location.href=js_var_object.main_url+"export";

    } );
    $( '#import_form' ).submit( function( e ) {
            $.ajax( {
                url: js_var_object.main_url+"import",
                beforeSend : function() {
                    $('#import_form').addClass('active');
                    $('.loading-indicator').show();
                },
                complete : function(result) {

                 }, success : function(result) {
                    $('#import_form').removeClass('active');
                   var res= JSON.stringify(result);
                  //  alert(res);
                    $('.loading-indicator').hide();
                    toastr.success('data inserted successfully procedure ',result.rows);
                    $('#datagrid').datagrid('reload');

                },
                type: 'POST',
                data: new FormData( this ),
                processData: false,
                contentType: false
            } );
            e.preventDefault();
        } );

    $("#ubmit_import").click(function(){

    $.post(js_var_object.main_url+"import",{data:$('#import_form').serialize()},function(result){
            alert(result);

        },'json');
    });

        $('#open_new_dialog').click(function (){
            $('#submit_add').show();
            $('#submit_edit').hide();
            $("#mymodal").dialog("open");
        } );
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
            width:1030,
            fixed:true,
            queryParams:{
                action:'get_data'
            },
            method:'get',
            pageSize:10,
            autoRowHeight:true,
            rowStyler:function (index, row) {

                return 'height:35px;  border:2px solid #000';

            }, columns:[
                [
                    {field:'action', title:'Action', type:'label', width:70, align:'center',
                        formatter:function (value, row, index){

                            if (row.editing) {
                                var s = '<a href="javascript:void(0);" onclick="_edit(' + index + ')"><img src="<?php echo SITE_LINK."/assets" ?>/img/save.png" alt="Save"/></a> ';
                                var c = '<a href="javascript:void(0);" onclick="cancelrow(' + index + ')"><img src="<?php echo SITE_LINK."/assets" ?>/img/cancel.png" alt="Cancel"/></a>';
                                var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')"><img src="<?php echo SITE_LINK."/assets" ?>/img/view.png" alt="view"/></a>';
                                return "<div>" +s+c+ "</div>";
                            } else {
                                var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><img src="<?php echo SITE_LINK."/assets" ?>/img/edit.pn" alt=""/><i class="icon-pencil bigger-130"></i></a> ';
                                var d = '<a href="javascript:void(0);" onclick="_delete(' + index + ')"><img src="<?php echo SITE_LINK."/assets" ?>/img/delete.pn" alt=""/><i class="icon-trash bigger-130"></i></a>';
                                var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')" ><img src="<?php echo SITE_LINK."/assets" ?>/img/view.png" alt="view"/></a>';
                                return "<div>" + e + d + "</div>";
                            }
                        }

                    },
                    {field:'id', title:"User id ", width:100, align:'center', sortable:true},

                    {field:'name', title:"Name", width:200, align:'center', sortable:true,
                        editor:{
                            type:'text'
                        }
                    },

                    {field:'email', align:'center', title:"Email", width:200, sortable:true,
                        editor:{
                            type:'text'

                        }},
                    {field:'address', align:'center', title:"Address", width:200, sortable:true,
                        editor:{
                            type:'text'

                        }},
                    {field:'phone', align:'center', title:"Phone", width:200, sortable:true,
                        editor:{
                            type:'text'

                        }
                    }


                ]
            ],
            onBeforeLoad:function (param) {
            },
            onLoadSuccess:function (data) {


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

    }).datagrid('enableFilter', [

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


function saveItem(index) {
    var row = $('#dg').datagrid('getRows')[index];
    var url = row.isNewRecord ? 'save_user.php' : 'update_user.php?id=' + row.id;
    $('#datagrid').datagrid('getRowDetail', index).find('form').form('submit', {
        url:url,
        onSubmit:function () {
            return $(this).form('validate');
        },
        success:function (data) {
            data = eval('(' + data + ')');
            data.isNewRecord = false;
            $('#datagrid').datagrid('collapseRow', index);
            $('#datagrid').datagrid('updateRow', {
                index:index,
                row:data
            });
        }
    });
}
function cancelItem(index) {
    var row = $('#datagrid').datagrid('getRows')[index];
    if (row.isNewRecord) {
        $('#datagrid').datagrid('deleteRow', index);
    } else {
        $('#datagrid').datagrid('collapseRow', index);
    }
}
function destroyItem() {
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this user?', function (r) {
            if (r) {
                var index = $('#dg').datagrid('getRowIndex', row);
                $.post('destroy_user.php', {id:row.id}, function () {
                    $('#datagrid').datagrid('deleteRow', index);
                });
            }
        });
    }
}
function newItem() {
    $('#datagrid').datagrid('appendRow', {isNewRecord:true});
    var index = $('#datagrid').datagrid('getRows').length - 1;
    $('#datagrid').datagrid('expandRow', index);
    $('#datagrid').datagrid('selectRow', index);
}

