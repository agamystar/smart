var for_upload;
var flage=true;
function edit_dialog(index) {


    $.each($('#mymodal input.required'),function(x,y){

        $(this).closest(".form-group").removeClass('has-error');

    });

    $('#my_photo').show();
    $('#datagrid').datagrid('selectRow', index);
    var selection = $('#datagrid').datagrid('getSelected');
    for_upload=selection.id;

    $('#name').val(selection.name);

    $('#job').val(selection.job);
    $('#username').val(selection.username);
    $('#national_id').val(selection.national_id);
    $('#birthday').datebox("setValue",selection.birthday);
    $('#address').val(selection.address);
    $('#blood_group').val(selection.blood_group);
    $('#email').val(selection.email);
    $('#select_group').val(selection.groups);

      $('#phone').val(selection.phone);
    if(selection.phone>3){
        $('#photo').show();
        $('#upload_form').hide();
        $('#my_photo img').attr("src",js_site_link+"/assets/uploads/" +selection.photo);
    }else{
        $('#my_photo').hide();
        $('#upload_form').show();
    }
    $('#sex').val(selection.sex);
    $('#bus_fees').val(selection.bus_fees);
    $('#stage').val(selection.stage);
    $('#stage').trigger("change");
    $('#level').val(selection.level);

    $('#kid').val(selection.id);
    $('#password').val('******************');

    $('#username').attr("disabled","disabled");
    $('#password').attr("disabled","disabled");
    $('#password').removeClass("required");

    $('#submit_add').hide();
    $('#submit_edit').show();
    $("#mymodal").dialog("open");

}
function _delete(index) {
    $('#datagrid').datagrid('selectRow', index);
    bootbox.confirm('Are you sure you want to delete this Record ? ',function(yes){
            if(yes){
                $('.bootbox-close-button.close').trigger("click");
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
function getRowIndex(target) {
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}
function add_edit(action) {
   var count_error=0;
    $('#username').removeAttr("disabled");
    $('#password').removeAttr("disabled");
    $('#password').addClass("required");


    var addnewrow = {
        name:$('#name').val(),
        national_id:$('#national_id').val(),
        email:$('#email').val(),
        groups:$('#select_group').val(),
        username:$('#username').val(),
        password:$('#password').val(),
        job:$('#job').val(),
        phone:$('#phone').val(),
        birthday:$('#birthday').datebox("getValue"),
        sex:$('#sex').val(),
        religion:$('#religion').val(),
        blood_group:$('#blood_group').val(),
        address:$('#address').val(),
        bus_fees:$('#bus_fees').val(),
        stage:$('#stage').val(),
        level:$('#level').val(),
        id:$('#kid').val()

    };


    $.each($('#mymodal input.required'),function(x,y){


        if( $(this).val()<1){
         $(this).closest(".form-group").addClass('has-error');
            count_error++;
        }

    }
    );

if(count_error<1){
   $('.loading-indicator').show();
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

}

$(function () {

    $('input.date').datebox({
        height:30,
        width:280

    });

    $('#open_new_dialog').click(function (){

        $('#username').removeAttr("disabled");
        $('#password').removeAttr("disabled");
        $("#mymodal input").val("");

        $('#reset_btn').trigger("click");
        $('#my_photo').hide();
        $('#upload_form').show();
        $('div#password_section').show();
        $('div#r_password_section').show();
        $('#submit_add').show();
        $('#submit_edit').hide();
        $("#mymodal").dialog("open");
    } );
    $('#cancel').click(function () {
        $("#mymodal").dialog("close");
    });

    $('a#change_photo').click(function(){
        $('#upload_form').show();
        $('#my_photo').hide();
    });
    $('#id-input-file-3').ace_file_input({
        style:'well',
        btn_choose:'Drop files here or click to choose',
        btn_change:null,
        no_icon:'icon-cloud-upload',
        droppable:true,
        thumbnail:'small',//large | fit|small
        //,icon_remove:null//set null, to hide remove/reset button
        before_change:function(files, dropped) {

            $('#loading').show();
            if(flage==true){
            $("#upload_form").submit(function(e){

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: js_site_url+"/security/f_upload/"+for_upload,
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (returndata) {
                        if(returndata.length<30){
                            toastr.success('Image Uploaded  Successfully  ');
                            for_upload="";
                        }else{
                            toastr.error(returndata);
                        }
                        $('#loading').hide();
                    }
                });
                e.preventDefault();
                return false;
            });
            }
            flage=false;
            $('#submit_file').trigger("click");
            return true;
        }
        /**,before_remove : function() {
         return true;
         }*/
        ,
        preview_error : function(filename, error_code) {

        }

    }).on('change', function(){

        });
    $('a#activation').click(function(){

        var selection = $('#datagrid').datagrid('getSelected');
        var  new_active;
        if(selection.active=="1"){
            new_active=0;
        }else{
            new_active=1;
        }
        $.post(js_var_object.current_link,{
            action:"activation" ,
            activation:new_active,
            id:selection.id
        },function(result){

            if (result.message == "success") {
                toastr.success('successfully  ');
                if(new_active=="0"){
                $('#active_span').show();
                $('#disactive_span').hide();
                    $('#datagrid').datagrid('reload');
                }
                else{
                    $('#active_span').hide();
                    $('#disactive_span').show();
                    $('#datagrid').datagrid('reload');
                }
            } else {
                toastr.error('Failed  ');
            }

        },'json')

    });





    $('#submit_add').click(function () {
        add_edit("create_user");
    });
    $('#submit_edit').click(function () {
        add_edit("edit_user");
    });



    $('#submit_reset').click(function(){
        $('#loading_reset').show();
        var selection = $('#datagrid').datagrid('getSelected');

        $.post(js_var_object.current_link,{
            action:"reset_password" ,
            password:$('#res_password').val(),
            id:selection.id
        },function(result){

            if (result.message == "success") {
                toastr.success('successfully Updated ');//Success Info Warning Error
                $('#loading_reset').hide();
            } else {
                toastr.error('Failed  ');//Success Info Warning Error
            }

        },'json')

    });


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
        modal: true,
        closed: true,
        title:'  ',
        height: 550,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
    });
    $("#change_dialog").dialog({
        width:500,
        modal: true,
        closed: true,
        title:'  ',
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
    });

    $("#import_dialog").dialog({
        width:500,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true,
        modal: true,
        closed: true,
        title:' '
    });

    $("#export_dialog").dialog({
        width:500,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true,
        modal: true,
        closed: true,

        title:' '
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

        modal: true,
        closed: true,
        title:'  '
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
            width:1115,
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

            }, rowStyler:function(index,row){
           if(row.groups=="not_defined"||row.groups==""||row.groups==null||row.active=="0"){
                   return 'color:red';

           }
       }, columns:[
                [
                    {field:'action', title:'#', type:'label', width:40, align:'center',
                        formatter:function (value, row, index){
                            if(js_var_object.hrw=="w"){
                                var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                                var d = '<a href="javascript:void(0);" onclick="_delete(' + index + ')"><i class="icon-trash bigger-130"></i></a>';
                               return e+d;
                            }
                        }

                    },
                   // {field:'id', title:"Id", width:60, align:'center', sortable:true},

                    {field:'name', title:"Name", width:200, align:'center', sortable:true
                    },
                    {field:'username', title:"User Name", width:200, align:'center', sortable:true
                    },


                    {field:'email', align:'center', title:"Email", width:210, sortable:true},
                    {field:'phone', align:'center', title:"Phone", width:140, sortable:true},
                    {field:'national_id', align:'center', title:"National No", width:170, sortable:true},
                    {field:'last_login', align:'center', title:"Last Login", width:150, sortable:true}

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
                    $('#div_for_other').hide();

                }else{
                    $('#div_for_student').hide();
                    $('#div_bus_fees').hide();

                    $('#div_for_other').show();
                    $('#job_text').html("Job");
                }

                if($('#select_group option:selected').val()=="teacher"){
                    $('#div_for_other').show();
                    $('#job_text').html("Subject");
                }


            }, onDblClickRow:function (rowIndex, rowData) {

            }, onSelect:function (rowIndex, rowData) {

            if(rowData.active=="1"){

                $('#active_span').hide();
                $('#disactive_span').show();
            }else{
                $('#disactive_span').hide();
                $('#active_span').show();
            }

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


