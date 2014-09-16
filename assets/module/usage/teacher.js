var content=[];
function undo(){
    $('#datagrid').datagrid('reload');
}

function cancelrow(target){
    var editors = $('#datagrid').datagrid('getEditors', target);
    if(editors[0]!=undefined){
        if(editors[0].target.val().length>0||editors[1].target.val().length>0){

        }else{
            $('#datagrid').datagrid('deleteRow',target);
        }
    }
    $('#datagrid').datagrid('cancelEdit',target);
    return false;
}

function start_edit(id) {
    $('#datagrid').datagrid('beginEdit', id);
}
function updateActions(index){
    $('#datagrid').datagrid('updateRow',{
        index: index,
        row:{}
    });
}
function getRowIndex(target){
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}
function add(){

    $.post(
        js_var_object.current_link,
        {
            action: 'add',
            key:$('input#key').val(),
            english:$('input#english').val(),
            arabic:$('input#arabic').val()

        },function(result){
            if(result.result=="success"){
                toastr.success('successfully procedure ');//Success Info Warning Error

            }else{
                toastr.error('Failed procedure ');//Success Info Warning Error
            }

            $('#datagrid').datagrid("reload");
        },'json'
    );
}

function editrow(target){
    $('#datagrid').datagrid('selectRow',target);
    $('#datagrid').datagrid('beginEdit', target);

    return false;
}
function _edit(index){
    $('#datagrid').datagrid('selectRow',index);
    var selection=$('#datagrid').datagrid('getSelected');
    $('#datagrid').datagrid('endEdit',index);

    $.post(
        js_var_object.current_link,
        {
            action: 'edit',
            row:JSON.stringify(selection)

        },function(result){
            if(result.result=="success"){
                toastr.success('successfully procedure ');//Success Info Warning Error

            }else{
                toastr.error('Failed procedure ');//Success Info Warning Error
            }

            $('#datagrid').datagrid("reload");
        },'json'
    );

}
function _delete(index){
    $('#datagrid').datagrid('selectRow',index);
    $.messager.confirm("delete", "delete ? ", function (r) {
        if (r) {
            var selection=$('#datagrid').datagrid('getSelected');
            $('#datagrid').datagrid('deleteRow',index);

            $.post(
                js_var_object.current_link,
                {
                    action: 'delete',


                },function(result){
                    if(result.result=="success"){
                        toastr.success('successfully procedure ');//Success Info Warning Error

                    }else{
                        toastr.error('Failed procedure ');//Success Info Warning Error
                    }

                    $('#datagrid').datagrid("reload");
                },'json'
            );
        }
    });

    return false;
}


$(function(){


    $('#submit_btn').click(function(){

      add();
    });
    $('#open_new_dialog').click(function(){


        content.push($('#new_dialog').clone(true));

        bootbox.dialog({
            message: content[0].css('visibility','visible'),
            title: "Custom title",
            model:true,
            buttons: {
                success: {
                    label: "Submit!",
                    className: "btn-success",
                    callback: function() {
                     add();
                    }
                },
                danger: {
                    label: "Cancel !",
                    className: "btn-danger bootbox-close-button ",
                    callback: function() {
                   //  cancel();
                    }
                }

            }
        });

        $("#new_dialog").remove();
    });
    $('#cancel_btn').click(function(){
        bootbox.close();
    });



    $('#datagrid').datagrid({
        url: js_var_object.current_link,
        singleSelect: true,
        rownumbers: false,
        pagination: true,
        sortName: 'released',
        sortOrder: 'desc',
        width:1040,
        fixed:true,
        queryParams: {
            action: 'get_data'
        },
        method: 'get',
        pageSize: 10,
        autoRowHeight:true,
        rowStyler:function(index,row){

            return 'height:35px;  border:2px solid #000';

        }
       , columns: [
            [

                {field:'action',title:'Action',type:'label', width:70,align:'center',
                formatter:function(value,row,index){

                    if (row.editing){
                        var s = '<a href="javascript:void(0);" onclick="_edit('+index+')"><img src="./assets/img/save.png" alt="Save"/></a> ';
                        var c = '<a href="javascript:void(0);" onclick="cancelrow('+index+')"><img src="./assets/img/cancel.png" alt="Cancel"/></a>';
                        var v = '<a href="javascript:void(0);" onclick="viewrow('+index+')"><img src="./assets/img/view.png" alt="view"/></a>';
                        return "<div>"+v+s+c+"</div>";
                    } else {
                        var e = '<a href="javascript:void(0);" onclick="editrow('+index+')"><img src="./assets/img/edit.png" alt="Edit"/></a> ';
                        var d = '<a href="javascript:void(0);" onclick="_delete('+index+')"><img src="./assets/img/delete.png" alt="Delete"/></a>';
                        var v = '<a href="javascript:void(0);" onclick="viewrow('+index+')"><img src="./assets/img/view.png" alt="view"/></a>';
                        return "<div>"+v+e+d+"</div>";
                    }}

            },
                {field: 'teacher_id', title: "ID", width: 70, align: 'center', sortable: true},

                {field: 'name', title: "Name", width: 180,align: 'center', sortable: true,
                    editor: {
                        type: 'text'
                    }
                },
                {field: 'birthday', title: "Birthday",align: 'center', width:100, sortable: true,
                    editor: {
                    type: 'text'
                }
                },
                {field: 'email',align: 'center', title: "Email",width: 130, sortable: true ,
                    editor: {
                    type: 'text'
                    }
                },
                {field: 'phone',align: 'center', title: "Phone",width: 100, sortable: true ,
                    editor: {
                        type: 'text'

                    }
                } ,
                {field: 'address',align: 'center', title: "Address",width: 140, sortable: true ,
                    editor: {
                        type: 'text'

                    }},
                {field: 'sex',align: 'center', title: "Sex",width: 60, sortable: true ,
                    editor: {
                        type: 'text'

                    }
                },{field: 'religion',align: 'center', title: "Religion",width: 80, sortable: true ,
                editor: {
                    type: 'text'

                }
            },
                {field: 'blood_group',align: 'center', title: "Blood Group",width: 100, sortable: true ,
                editor: {
                    type: 'text'

                }
            }

            ]],
        onBeforeLoad: function (param){},
        onLoadSuccess: function (data) {


        }, onDblClickRow: function (rowIndex, rowData) {

        }
        , onSelect: function (rowIndex, rowData) {

        },
        onBeforeEdit:function(index,row){
            row.editing = true;
            updateActions(index);
        },
        onAfterEdit:function(index,row){
            row.editing = false;
            updateActions(index);
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            updateActions(index);
        }
    }). datagrid('enableFilter', [

        {
            field: 'teacher_id',
            type: 'text',
            op: ['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field: 'name',
            type: 'text',

            op: ['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field: 'birthday',
            type: 'text',

            op: ['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        },
        {
            field: 'email',
            type: 'text',

            op: ['equal', 'notequal', 'contains', 'notcontains', 'beginwith', 'notbeginwith', 'endwith', 'notendwith', 'or_equal', 'or_notequal', 'or_contains', 'or_notcontains', 'or_beginwith', 'or_notbeginwith', 'or_endwith', 'or_notendwith']
        }


    ]);



});

