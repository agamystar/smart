
function getRowIndex(target) {
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}
function add_edit(action) {
    $('.loading-indicator').show();

    var addnewrow = {
        student_id:$('#student_name').combogrid("getValue"),
        stage:$('#stage').val(),
        level:$('#level').val(),
        expenses_id:$('#expenses').val(),
        installment_id:$('#installments').val(),
        paid_date:$('#paid_date').datebox("getValue"),
        amount:$('#amount').val(),
        expenses_discount:$('#expenses_discount').val(),
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

            $('#datagrid').datagrid("reload",{ action:'get_data',
                stage:$('select#stage').val(),
                level:$('select#level').val(),
                expense:$('select#expenses').val(),
                installment:$('select#installments').val()});
        }, 'json'
    );


}

function editrow(target) {
    $('#datagrid').datagrid('selectRow', target);
    $('#datagrid').datagrid('beginEdit', target);

    return false;
}
function _delete(index, id) {
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

                    $('#datagrid').datagrid("reload",{ action:'get_data',
                        stage:$('select#stage').val(),
                        level:$('select#level').val(),
                        expense:$('select#expenses').val(),
                        installment:$('select#installments').val()});
                }, 'json'
            );


            return false;
        }
    })

}
function edit_dialog(index) {
    $('#datagrid').datagrid('selectRow', index);
    var selection = $('#datagrid').datagrid('getSelected');
    $('#student_name').combogrid("setValue",selection.student_id);
    $('#amount').val(selection.amount);
    $('#expenses_discount').val(selection.discount);
    $('#paid_date').datebox("setValue",selection.paid_date);
    $('#kid').val(selection.class_id);
    $('#submit_add').hide();
    $('#submit_edit').show();
    $("#mymodal").dialog("open");
}

var d = new Date();
var month = d.getMonth() + 1;
var day = d.getDate();
var output = (day < 10 ? '0' : '') + day + '/' + (month < 10 ? '0' : '') + month + '/' + d.getFullYear();


$(function () {

    $('.date').datebox();

    $.messager.progress({
        title: 'processing .... ',
        msg: 'Wait .... ',
        text: 'PROCESSING.......'
    });




    $('input.date').datebox({
        height:30,
        width:200
    });

    $('input.date').datebox("setValue", output);


    $('select#stage').change(function () {

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

        $('select#level').html(options);
        $('select#level').trigger("change");


    });
    $('select#stage').trigger("change");
    setTimeout(function () {
        $('select#level').trigger("change");
    }, 1000);
    $('select#level').change(function () {

        var selected_level = $(this).val();

        var _options = "";
        var result = $.grep(js_var_object.expenses, function (x) {
                return   x.expenses_stage === $('select#stage').val() && x.expenses_level === selected_level;
            }
        );
        $.each(result, function (x, y) {

            _options += "<option ref=" + y.expenses_value + " value=" + y.expenses_id + ">" + y.expenses_name + "</option>";
        });


        $('select#expenses').html(_options);




        $('input#student_name').combogrid({
            url:js_var_object.current_link,
            singleSelect:true,
            rownumbers:false,
            pagination:true,
            sortName:'released',
            sortOrder:'desc',
            width:410,
            height:30,
            idField:'id',
            textField:'name',
            panelHeight:500,
            fixed:true,
            queryParams:{
                action:'get_students',
                stage:$('#stage').val(),
                level:selected_level
            },
            method:'get',
            pageSize:20,
            autoRowHeight:true,
            columns:[
                [
                    {field:'name', align:'center', title:" Name", width:200, sortable:true },
                    {field:'national_id', title:"National No", width:150, align:'center', sortable:true}
                ]
            ],
            onLoadSuccess:function (data) {
                $.messager.progress('close');
            }

        });





    });


    $('select#expenses').change(function () {
        $.messager.progress({
            title: 'Validation',
            msg: 'Checking Code ',
            text: 'PROCESSING.......'
        });

        var selected_ex = $(this).val();
        var __options = "";
        var results = $.grep(js_var_object.installments, function (x) {
                return   x.expenses_id === selected_ex;
            }
        );

        //&& x.expenses_level===selected_level;

        $.each(results, function (x, y) {

            __options += "<option ref=" + y.value + "  value=" + y.installment_id + ">" + y.name + "</option>";

        });

        $('select#installments').html(__options);
        $('select#installments').trigger("change");
        $('#expenses_value').text($('select#expenses option:selected').attr("ref"));
        $.messager.progress('close');
    });




    setTimeout(function () {
        $('select#expenses').trigger("change");
    }, 2000);


    $('select#installments').change(function () {
        $('#grid_container').show();
        $('#installment_value').text($('select#installments option:selected').attr("ref"));





    });

    setTimeout(function () {
        $('select#installments').trigger("change");
    }, 3000);

$('#stage,#level,#installments,#expenses').change(function(){

    $('#grid_container').css("visibility","hidden");
});

    $('#datagrid').datagrid();

$('#filter').click(function(){
    $.messager.progress({
        title: 'Validation',
        msg: 'Checking Code ',
        text: 'PROCESSING.......'
    });

    $('#grid_container').css("visibility","visible");


    $('#datagrid').datagrid({
        url:js_var_object.current_link,
        singleSelect:true,
        rownumbers:false,
        pagination:true,
        sortName:'released',
        sortOrder:'desc',
        width:1110,
        fixed:true,
        queryParams:{
            action:'get_data',
            stage:$('select#stage').val(),
            level:$('select#level').val(),
            expense:$('select#expenses').val(),
            installment:$('select#installments').val()
        },
        method:'get',
        pageSize:20,
        autoRowHeight:true,
        rowStyler:function (index, row) {
            var am=parseInt(row.amount)+parseInt(row.discount);
if(am>=parseInt($('#installment_value').text())){
            return ' font-weight: bold;color:green;font:20px;';
}
            if(parseInt($('#installment_value').text())/2 > am){
                return ' font-weight: bold;color:red;font:20px;';
            }

        }, columns:[
            [
                {field:'action', title:'#', type:'label', width:50, align:'center',
                    formatter:function (value, row, index) {


                        var e = '<a href="javascript:void(0);" onclick="edit_dialog(' + index + ')"><i class="icon-pencil bigger-130"></i></a> ';
                        var d = '<a href="javascript:void(0);" onclick="_delete(' + index + ',\'' + row.class_id + '\')"><i class="icon-trash bigger-130"></i></a>';
                        var v = '<a href="javascript:void(0);" onclick="_show_details(' + index + ')" ></a>';
                        return "<div>" + e + d + "</div>";
                    }

                },
                {field:'name', align:'center', title:"Student Name", width:280, sortable:true },
                {field:'national_id', title:"National No", width:220, align:'center', sortable:true},
                {field:'discount', align:'center', title:"Discount", width:150, sortable:true },
                {field:'paid_date', align:'center', title:"Paid In", width:250, sortable:true },
                {field:'amount', align:'center', title:" Amount ", width:150, sortable:true }


            ]
        ],
        onBeforeLoad:function (param) {
        },
        onLoadSuccess:function (data) {

            $.messager.progress('close');
            $('input.date').datebox("setValue", output);


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








});



    $("#mymodal").dialog({
        width:550,
        height:335,
        modal:true,
        closed:true,
        title:'   ',
        draggable:true,
        top:50,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
    });


    $("#import_dialog").dialog({
        width:500,
        height:230,
        modal:true,
        closed:true,
        title:'',
        draggable:true,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
    });

    $("#export_dialog").dialog({
        width:500,
        height:230,
        modal:true,
        closed:true,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true,
        title:'',
        draggable:true
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
                $('#datagrid').datagrid('reload',{ action:'get_data',
                    stage:$('select#stage').val(),
                    level:$('select#level').val(),
                    expense:$('select#expenses').val(),
                    installment:$('select#installments').val()});

            },
            type:'POST',
            data:new FormData(this),
            processData:false,
            contentType:false
        });
        e.preventDefault();
    });


    $('#open_new_dialog').click(function () {
        // $('#reset_btn').trigger("click");
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


});

