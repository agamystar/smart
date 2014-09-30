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
function editrow(target) {
    $('#datagrid').datagrid('selectRow', target);
    $('#datagrid').datagrid('beginEdit', target);

    return false;
}
function _delete(index) {
    $('#datagrid').datagrid('selectRow', index);
    bootbox.confirm('Are you sure you want to delete this Record ? ',function(yes){
            if(yes){
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

            }}
    );
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
        groups:$('#select_group').val(),
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
        bus_fees:$('#bus_fees').val(),
        stage:$('#stage').val(),
        level:$('#level').val(),
        id:$('#kid').val()


    };


    $.post( js_var_object.current_link,
        {
            action:action,
            row_add:JSON.stringify(addnewrow)
        }, function (result) {
            if (result.result == "success") {
                toastr.success('Success  ');//Success Info Warning Error

                $('.loading-indicator').hide();
                $("#mymodal").dialog("close");
            } else {
                toastr.error('Failed   ');//Success Info Warning Error

            }

            $('#datagrid').datagrid("reload");
        }, 'json'
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
$('#select_group').val(selection.groups);
$('#phone').val(selection.phone);
$('#photo').val(selection.photo);
$('#sex').val(selection.sex);
$('#bus_fees').val(selection.bus_fees);
$('#stage').val(selection.stage);
$('#stage').trigger("change");
$('#level').val(selection.level);

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

    var loading=false;
    $('#select_class').combotree({
        url: js_var_object.current_link+"?action=load_classes",
        editable:false,
         height:30,
        onSelect: function(node){
            if(node.id==""||node.id==null){
             //  alert("Select Class");
                $('#select_class').combotree("setValue",1);
            }
        },
        onLoadSuccess:function(node){
            loading=true;
        }
    });
   $('#select_group').change(function(){
       var group= $(this).val();
       $('#datagrid').datagrid("reload",{
           action:'get_data',
           user_group:group

       });

   });


    $("#mymodal").dialog({
        width:950,
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






    $('select#stage').change(function(){
        // alert($(this).val());
        var options='';
        var stage=$(this).val();

        var result = $.grep(js_var_object.levels, function(x){
                return   x.stage_id===stage;
            }
        );


        $.each(result,function(x,y){

            options+="<option value="+y.level_id+">"+ y.level_name+"</option>";
        });
        ///  alert(options);
        $('select#level').html(options)
    });


    $('select#stage').trigger("change");








    $('#datagrid').datagrid({
            url:js_var_object.current_link,
            singleSelect:true,
            rownumbers:false,
            pagination:true,
            sortName:'released',
            sortOrder:'desc',
            width:1050,
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

            }, rowStyler:function(index,row){
           if(row.groups=="student"){
           if (row.class_id==""||row.class_id==null||row.class_id=="0"){
               return 'color:red';
           }
           }
           if(row.groups=="not_defined"||row.groups==""||row.groups==null){
                   return 'color:red';

           }
       }, columns:[
                [
                    {field:'action', title:'Action', type:'label', width:40, align:'center',
                        formatter:function (value, row, index){
                                var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                                var d = '<a href="javascript:void(0);" onclick="_delete(' + index + ')"><i class="icon-trash bigger-130"></i></a>';
                               return e+d;
                        }

                    },
                   // {field:'id', title:"Id", width:60, align:'center', sortable:true},

                    {field:'name', title:"Name", width:150, align:'center', sortable:true
                    },
                    {field:'username', title:"User Name", width:150, align:'center', sortable:true
                    },


                    {field:'email', align:'center', title:"Email", width:150, sortable:true},
                    {field:'phone', align:'center', title:"Phone", width:120, sortable:true},
                    {field:'national_id', align:'center', title:"National No", width:150, sortable:true},
                    {field:'last_login', align:'center', title:"last_login", width:120, sortable:true},
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
                $('#add_text').text("Add  "+$('#select_group option:selected').text());
                if($('#select_group option:selected').val()=="student"){
                    $('#div_for_student').show();
                    $('#div_bus_fees').show();

                }else{
                    $('#div_for_student').hide();
                    $('#div_bus_fees').hide();
                }


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


