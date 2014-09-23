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
        name:$('#name').val(),
        national_id:$('#national_id').val(),
        email:$('#email').val(),
        groups:$('#group').val(),
        username:$('#username').val(),
        password:$('#password').val(),
        id:$('#user_id').val(),
        phone:$('#phone').val(),
        photo:$('#photo').val(),
        birthday:$('#birthday').val(),
        sex:$('#sex').val(),
        religion:$('#religion').val(),
        blood_group:$('#blood_group').val(),
        address:$('#address').val(),
        id:$('#kid').val()


    };


    $.post( js_var_object.current_link,
        {
            action:action,
            row_add:JSON.stringify(addnewrow)
        }, function (result) {
            if (result.result == "success") {
                toastr.success('User Created Successfully  ');//Success Info Warning Error

                $('.loading-indicator').hide();
                $("#mymodal").dialog("close");
            } else {
                toastr.error('Failed Process  ');//Success Info Warning Error

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
    bootbox.confirm('Are you sure you want to delete this Record ? ',function(yes){
        if(yes){
    $.messager.confirm("delete", "Are you sure you want to delete this Record ? ", function (r) {

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


    return false;
})
}}
);
}
function edit_dialog(index) {
$('#datagrid').datagrid('selectRow', index);
 var selection = $('#datagrid').datagrid('getSelected');
$('#username').attr("disabled","disabled");
$('#password').attr("disabled","disabled");

$('#name').val(selection.name);
$('#username').val(selection.username);
$('#national_id').val(selection.national_id);
$('#birthday').val(selection.birthday);
$('#address').val(selection.address);
$('#blood_group').val(selection.blood_group);
$('#email').val(selection.email);
$('#group').val(selection.groups);
$('#phone').val(selection.phone);
$('#photo').val(selection.photo);
$('#kid').val(selection.id);
$('#password').val('******************');

    $('#submit_add').hide();
    $('#submit_edit').show();
    $("#mymodal").dialog("open");

}
function activation(act,id){
    var action;
    if(act==1){
        action="dis_active_user";
    }else{
        action="active_user";
    }
    $.ajax( {
        url: js_var_object.current_link,
        beforeSend : function() {
            $('#change_form').addClass('active');
            $('.loading-indicator').show();
        }, success : function(result) {
            toastr.success('data inserted successfully procedure ',result.rows);
            $('#datagrid').datagrid('reload');
        },
        type: 'POST',
        data: {action:'active_user',user_id:id},
        processData: false,
        contentType: false
    } );
}
$(function () {

   $('#select_group').change(function(){
       var group= $(this).val();
       $('#datagrid').datagrid("reload",{
           action:'get_data',
           user_group:group

       });

   });
    $("#mymodal").dialog({
        width:900,
        autoOpen:false,
        modal: true,
        closed: true,
        title:' User '
    });
    $("#change_dialog").dialog({
        width:500,
        autoOpen:false,
        modal: true,
        closed: true,
        title:'Reset password '
    });

    $("#import_dialog").dialog({
        width:500,
        autoOpen:false,
        modal: true,
        closed: true,
        title:'Import Form'
    });

    $("#export_dialog").dialog({
        width:500,
        autoOpen:false,
        modal: true,
        closed: true,

        title:'Export Form'
    });


    $('#export').click(function(){


              location.href=js_var_object.current_link+"/export/"+$('#select_group').val();


    });

    $('#import').click(function(){

                $("#import_dialog").dialog("open");


    });


    $( '#import_form' ).submit( function( e ) {
        $.ajax( {
            url: js_var_object.current_link+"/import/"+$('#select_group').val(),
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

    $("#reset_dialog").dialog({
        width:530,
        autoOpen:false,
        modal: true,
        closed: true,
        title:'Reset  Form'
    });

    $('#reset_password').click(function(){
        $("#reset_dialog").dialog("open");
    });

    $( '#change_form' ).submit( function( e ) {
            var data={username:$('#username').val(),new_password:$('#password').val()};
            $.ajax( {
                url: js_var_object.current_link+"reset_password",
                beforeSend : function() {
                    $('#change_form').addClass('active');
                    $('.loading-indicator').show();
                },
                complete : function(result) {

                 }, success : function(result) {
                    $('#change_form').removeClass('active');
                   var res= JSON.stringify(result);
                  //  alert(res);
                    $('.loading-indicator').hide();
                    toastr.success('data inserted successfully procedure ',result.rows);
                    $('#datagrid').datagrid('reload');

                },
                type: 'POST',
                data: JSON.stringify(data),
                processData: false,
                contentType: false
            } );
            e.preventDefault();
        } );



        $('#open_new_dialog').click(function (){
         $('#reset_btn').trigger("click");
            $('div#password_section').show();
            $('div#r_password_section').show();
            $('#submit_add').show();
            $('#submit_edit').hide();
            $("#mymodal").dialog("open");
        } );
        $('#cancel').click(function () {
            $("#mymodal").dialog("close");
        });



    $('#submit_add').click(function () {
        add_edit("create_user");
    });
    $('#submit_edit').click(function () {
        add_edit("edit_user");
    });



   $('#datagrid').datagrid({
            url:js_var_object.current_link,
            singleSelect:true,
            rownumbers:false,
            pagination:true,
            sortName:'released',
            sortOrder:'desc',
            width:1040,
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
                    {field:'action', title:'Action', type:'label', width:40, align:'center',
                        formatter:function (value, row, index){

                            if (row.editing) {
                                var s = '<a href="javascript:void(0);" onclick="_edit(' + index + ')"><img src="./assets/img/save.png" alt="Save"/></a> ';
                                var c = '<a href="javascript:void(0);" onclick="cancelrow(' + index + ')"><img src="./assets/img/cancel.png" alt="Cancel"/></a>';
                                var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')"><img src="./assets/img/view.png" alt="view"/></a>';
                                return "<div>" +s+c+ "</div>";
                            } else {
                                var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><img src="./assets/img/edit.pn" alt=""/><i class="icon-pencil bigger-130"></i></a> ';
                                var d = '<a href="javascript:void(0);" onclick="_delete(' + index + ')"><img src="./assets/img/delete.pn" alt=""/><i class="icon-trash bigger-130"></i></a>';
                                var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')" ><img src="./assets/img/view.png" alt="view"/></a>';
                                return "<div>" + e + d + "</div>";
                            }
                        }

                    },
                   // {field:'id', title:"Id", width:60, align:'center', sortable:true},

                    {field:'name', title:"Name", width:180, align:'center', sortable:true,
                        editor:{
                            type:'text'
                        }
                    },
                    {field:'username', title:"User Name", width:150, align:'center', sortable:true,
                        editor:{
                            type:'text'
                        }
                    },


                    {field:'email', align:'center', title:"Email", width:130, sortable:true,
                        editor:{
                            type:'text'

                        }},
                    {field:'phone', align:'center', title:"Phone", width:130, sortable:true,
                        editor:{
                            type:'text'

                        }},

                    {field:'national_id', align:'center', title:"National No", width:150, sortable:true,
                        editor:{
                            type:'text'

                        }
                    },
                    {field:'last_login', align:'center', title:"last_login", width:100, sortable:true,
                        editor:{
                            type:'text'

                        }},

                    {field:'active', align:'center', title:"Active", width:80, sortable:true,
                        formatter:function (value, row, index){

                            if(value==1){

                            // &#x2714;
                           return '<label class="pull-right inline">' +
                               ' <input  checked=""  oncheck="activation('+value+','+row.id+')" type="checkbox" class="ace ace-switch ace-switch-5"  id=\'active_' + index + '\'>' +
                               ' <span class="lbl"></span> </label>';
                            }else{
                           // &#x2718;
                                return '<label class="pull-right inline">' +
                                    ' <input id="id-pills-stack_"'+index+' type="checkbox" class="ace ace-switch ace-switch-5" />' +
                                    ' <span class="lbl"></span> </label>';
                            }
                          },
                        editor:{
                            type:'text'

                        }
                    }



                ]
            ],
            onBeforeLoad:function (param) {
            },
            onLoadSuccess:function (data) {

                $('#import_text').text("Import  "+$('#select_group option:selected').text());
                $('#export_text').text("Export  "+$('#select_group option:selected').text());

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

    $('input#active_0').on('click', function(){
        alert("ok");
    });



});


