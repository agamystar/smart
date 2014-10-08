
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
    name_numeric:$('#name_numeric').val(),
    stage:$('#stage').val(),
    level:$('#level').val(),
    teacher_id:$('#teacher_id').val(),
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
function editrow(target) {
    $('#datagrid').datagrid('selectRow', target);
    $('#datagrid').datagrid('beginEdit', target);

    return false;
}
function _delete(index,id) {
    $('#datagrid').datagrid('selectRow', index);
    bootbox.confirm('Are you sure you want to delete this Record ? ', function (yes) {
            if (yes) {

                $('.bootbox-close-button.close').trigger("click");
                  var selection = $('#datagrid').datagrid('getSelected');
                    $('#datagrid').datagrid('deleteRow', index);

                    $.post(
                        js_var_object.current_link,
                        {
                            action:'delete',
                            id:id

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
    })

}
function edit_dialog(index) {
    $('#datagrid').datagrid('selectRow', index);
    var selection = $('#datagrid').datagrid('getSelected');
    $('#name').val(selection.name);
    $('#name_numeric').val(selection.name_numeric);
    $('#stage').val(selection.stage);
    $('#level').val(selection.level);
    $('#teacher_id').val(selection.teacher_id);
    $('#kid').val(selection.class_id);
    $('#submit_add').hide();
    $('#submit_edit').show();
    $("#mymodal").dialog("open");
}

$(function () {

    var list_stages=[];
    $.each(js_var_object.stages,function(x,y){
        list_stages[y.stage_id]= y.stage_name;
    });

    var list_levels=[];
    $.each(js_var_object.levels,function(x,y){
        list_levels[y.level_id]= y.level_name;
    });

    var list_teachers=[];
    $.each(js_var_object.teachers,function(x,y){
        list_teachers[y.id]= y.name;
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



    $("#mymodal").dialog({
        width:550,

        modal:true,
        closed:true,
        title:'   '
    });


    $("#import_dialog").dialog({
        width:500,

        modal:true,
        closed:true,
        title:' '
    });

    $("#export_dialog").dialog({
        width:500,

        modal:true,
        closed:true,

        title:' '
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
        width:1100,
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
                {field:'action', title:'Action', type:'label', width:50, align:'center',
                    formatter:function (value, row, index) {


                            var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                            var d = '<a href="javascript:void(0);" onclick="_delete(' + index +',\''+row.class_id+'\')"><i class="icon-trash bigger-130"></i></a>';
                            var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')" ></a>';
                            return "<div>" + e + d + "</div>";
                    }

                },



                {field:'class_id', title:"Class", width:100, align:'center', sortable:true,
                    editor:{
                        type:'text'
                    }
                },
                {field:'name', title:"Name", width:100, align:'center', sortable:true,
                    editor:{
                        type:'text'
                    }
                },


                {field:'name_numeric', align:'center', title:"Name Numeric", width:130, sortable:true,
                    editor:{
                        type:'text'

                    }},
                {field:'stage', align:'center', title:"Stage", width:180, sortable:true,
                    formatter:function(value,row,index){
                    return list_stages[value];
                },
                    editor:{
                        type:'text'

                    }},

                {field:'level', align:'center', title:"Level", width:230, sortable:true,
                    formatter:function(value,row,index){
                        return list_levels[value];
                    },
                    editor:{
                        type:'text'

                    }
                },
                {field:'teacher_id', align:'center', title:"Teacher ", width:230, sortable:true,
                    formatter:function(value,row,index){
                        return list_teachers[value];
                    },
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


