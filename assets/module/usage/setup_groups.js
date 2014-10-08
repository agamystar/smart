var selected_group_id;
function getRowIndex(target) {
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}

function authorize(group_id){
    $('.loading-indicator').show();
    selected_group_id=group_id;
    $.get(js_var_object.current_link,{
            action:"get_group_forms",
            group_id:group_id
        },
        function(result){
            if(result[0]){
            var res=[];
            $.each(result,function(x,y){
                res.push(y.form_id);
            });

             $('input[name="h_r_w"][value="'+ result[0].h_r_w+'"]').attr("checked",true);
            }
            var boxes="";

            $.each(js_var_object.all_forms,function(x,y){

                if($.inArray(y.form_id,res)>-1){
              boxes+='<div class="checkbox col-sm-6">\
                <label><input name="forms_ids[]"  checked="checked"  value="'+ y.form_id+'" class="ace check " type="checkbox"> \
                 &nbsp;  <span class="lbl"></span>'+ y.name+' </label></div>';

                }else{
                    boxes+='<div class="checkbox col-sm-6">\
                <label><input name="forms_ids[]"    value="'+ y.form_id+'" class="ace check " type="checkbox"> \
                 &nbsp;  <span class="lbl"></span>'+ y.name+' </label></div>';
                }
            });

            $('#check_groups').html(boxes);


                $('.loading-indicator').hide();

            $('.loading-indicator').hide();

    },'json');

    $("#authority").dialog("open");

}
function add_edit(action) {
    $('#username').removeAttr("disabled");
    $('#password').removeAttr("disabled");

    $('.loading-indicator').show();
    var addnewrow = {
        name:$('#name').val(),
        description:$('#description').val(),
        show_front:$('#show_front').val(),
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
    bootbox.confirm('Are you sure you want to delete this Record ? ', function (result) {
            if (result) {
                $('.bootbox-close-button.close').trigger("click");
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

    $('#name').val(selection.name);
    $('#description').val(selection.description);
    $('#show_front').val(selection.show_front);
    $('#kid').val(selection.id);
    $('#submit_add').hide();
    $('#submit_edit').show();
    $("#mymodal").dialog("open");
}

$(function () {

    $("#mymodal").dialog({
        width:550,
        height:300,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true,
        modal:true,
        closed:true,
        title:'   '
    });

    $("#authority").dialog({
        width:500,
        height:500,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true,
        modal:true,
        closed:true,
        title:'   '
    });


    $('#submit_authority').click(function(){

        var values = new Array();
        $.each($("input[name='forms_ids[]']:checked"), function() {
            values.push($(this).val());
        });
        $('.loading-indicator').show();
        $.post(js_var_object.current_link,{
            action:"add_authority",
            group_id:selected_group_id,
            forms_ids:JSON.stringify(values),
            h_r_w:$("input[name='h_r_w']:checked").val()
        },function(result){
            if (result.message == "success") {
                toastr.success('  Success  ');//Success Info Warning Error

                $('.loading-indicator').hide();
                $("#mymodal").dialog("close");
            } else {
                toastr.error('Failed   ');//Success Info Warning Error

            }

        },'json')
    });
    $("#import_dialog").dialog({
        width:500,

        modal:true,
        closed:true,
        title:''
    });

    $("#export_dialog").dialog({
        width:500,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true,
        modal:true,
        closed:true,

        title:''
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
        pageSize:20,
        autoRowHeight:true,
        rowStyler:function (index, row) {

            return 'height:35px;  border:2px solid #000';

        }, columns:[
            [
                {field:'action', title:'#', type:'label', width:40, align:'center',
                    formatter:function (value, row, index) {


                            var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                            var d = '<a href="javascript:void(0);" onclick="_delete('+index +',\''+row.id+'\')"><i class="icon-trash bigger-130"></i></a>';

                            return "<div>" + e + d + "</div>";
                    }

                },
                // {field:'id', title:"Id", width:60, align:'center', sortable:true},

                {field:'id', title:"ID", width:100, align:'center', sortable:true,
                    editor:{
                        type:'text'
                    }
                },
                {field:'name', title:"Name", width:200, align:'center', sortable:true,
                    editor:{
                        type:'text'
                    }
                },


                {field:'description', align:'center', title:"Text", width:200, sortable:true,
                    editor:{
                        type:'text'

                    }},
                {field:'show_front', align:'center', title:"Show in Front Page", width:300, sortable:true,

                    formatter:function (value, row, index) {
                        if(value=="1"){
                            return " Yes ";
                        }else{
                            return " No ";
                        }

                    }

                }
,
                {field:'#####', align:'center', title:"Authorization", width:300, sortable:true,
                    formatter:function (value, row, index) {
                        return'<a href="javascript:void(0)" onclick="authorize('+row.id+')">  '+"Add Authorization"+"     </a>";
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


