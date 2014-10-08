$(function () {

    $('input.date').datebox({
        height:30,
        width:200,
        onSelect:function (node) {

             var y= node.getFullYear();
            var m = node.getMonth() + 1;
            var d = node.getDate();

            var _date = (d < 10 ? '0' : '') + d + '/' +(m < 10 ? '0' : '') + m + '/' + y;

            window.location = js_var_object.current_link + "?class=" +  $('#select_class').combotree("getValue")+"&date="+_date;
                // alert("select");

        }
        });


    $('input.date').datebox("setValue", js_var_object.p_date);


    $.each(js_var_object.absence, function (y, x) {
        // alert(x.user_id);
        $('.itemdiv.dialogdiv > .user > img' + '#' + x.user_id).addClass("check_person");
    });


    var loading = false;
    $('#select_class').combotree({
        url:js_var_object.current_link + "?action=load_classes",
        editable:false,
        onSelect:function (node) {
            if (node.id > 0 && loading == true) {
                window.location = js_var_object.current_link + "?class=" + node.id+"&date="+$('input.date').datebox("getValue");
                // alert("select");
            }
        },
        onLoadSuccess:function (node) {
            loading = true;
        }
    }).combotree("setValue", js_var_object.p_class);


    $('.itemdiv.dialogdiv > .user > img').click(function () {
        $(this).toggleClass('check_person');
    });
    $('.class_students').bootstrapDualListbox({
        nonSelectedListLabel:'<span class="label label-success arrowed-in arrowed-in-right">All Students That not have classes </span>',
        selectedListLabel:'<span class="label label-success arrowed-in arrowed-in-right">All Student in This Class</span> ',
        preserveSelectionOnMove:'moved',
        moveOnSelect:false
        //  nonSelectedFilter:'ion ([7-9]|[1][0-2])'
    });

    $('#id-pills-stacked').removeAttr('checked').on('click', function () {
        $('.nav-pills').toggle();
    });
    $("#import_dialog").dialog({
        width:500,
        cache:false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true,
        modal:true,
        closed:true,
        title:''
    });


    $('#import_form').attr("action", js_var_object.controller_link + "/import/" + $('#select_class').combotree("getValue"));


    $('a#export_class').click(function () {
        location.href = js_var_object.controller_link + "/export/" + $('#select_class').combotree("getValue");
    });

    $('a#import_class').click(function () {

        $("#import_dialog").dialog("open");


    });


    $('#import_form').submit(function (e) {
        $.ajax({
            url:$('#import_form').attr("action"),
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


    $('#add_to_class').click(function () {
        var student_absence = [];


        $('.itemdiv.dialogdiv > .user > img.check_person').each(function (y, x) {
            student_absence.push($(this).attr('id'));
        });

        $.post(js_var_object.current_link, {
            action:'set_student_absence',
            class:$('#select_class').combotree("getValue"),
            date:$('input.date').datebox("getValue") ,
            student_absence:student_absence,
            class:  $('#select_class').combotree("getValue")
        }, function (result) {
            if (result.message != "failed") {
                toastr.success('Success   ');
            } else {
                toastr.error('Failed   ');
            }
        }, 'json');
    });

});


