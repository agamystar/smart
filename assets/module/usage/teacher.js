
function getRowIndex(target) {
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}
function add_edit(action) {
    $('.loading-indicator').show();
    var addnewrow = {
        name:$('#name').val(),
        email:$('#email').val(),
        birthday:$('#birthday').val(),
        address:$('#address').val(),
        phone:$('#phone').val(),
        sex:$('#sex').val(),
        religion:$('#religion').val(),
        id:$('#kid').val()
    }
    $.post(
        js_var_object.current_link,
        {
            action:action,
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
    var row_add={};
    $('#datagrid').datagrid('selectRow', index);
    $.messager.confirm("delete", "Are you sure  ? ", function (r) {
        if (r) {
            var selection = $('#datagrid').datagrid('getSelected');
            $('#datagrid').datagrid('deleteRow', index);

            $.post(
                js_var_object.current_link,
                {
                    action:'delete',
                    row_add:JSON.stringify(selection)
                }, function (result) {
                    if (result.result == "success") {
                        toastr.success('successfully deleted  ');//Success Info Warning Error

                    } else {
                        toastr.error('Failed to Dalete  ');//Success Info Warning Error
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

    $('#submit_add').hide();
    $('#submit_edit').show();

    $("#mymodal").dialog("open");

}

$(function () {

    $("#mymodal").dialog({
        width:600,

        modal: true,
        closed: true,
        title:' '
    });
    $("#import_dialog").dialog({
        width:500,

        modal: true,
        closed: true,
        title:' '
    });

    $('#import').click(function(){
        $("#import_dialog").dialog("open");
    });

    $( '#export' ).click( function( e ) {

        location.href=js_var_object.current_link+"/export";

    } );
    $( '#import_form' ).submit( function( e ) {
        $.ajax( {
            url: js_var_object.current_link+"/import",
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
        pageSize:20,
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
                {field:'id', title:"Id", width:100, align:'center', sortable:true},

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

}).
    datagrid('enableFilter', [

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


