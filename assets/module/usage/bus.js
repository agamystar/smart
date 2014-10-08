$(function () {

    $('.bus_students').bootstrapDualListbox({
        nonSelectedListLabel:'<span class="label label-success arrowed-in arrowed-in-right">All Students That not have Bus </span>',
        selectedListLabel:'<span class="label label-success arrowed-in arrowed-in-right">All Student in This Bus</span> ',
        preserveSelectionOnMove:'moved',
        moveOnSelect:false
        //  nonSelectedFilter:'ion ([7-9]|[1][0-2])'
    });

    $('#id-pills-stacked').removeAttr('checked').on('click', function(){
        $('.nav-pills').toggle();
    });
    $("#import_dialog").dialog({
        width:500,
        height:300,
        modal: true,
        closed: true,
        title:'  ',
        height: 550,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:'true'
    });


    $('#import_form').attr("action",js_var_object.controller_link+"/import/"+ $('#select_bus').val());

    $('#select_bus').change(function () {

        window.location = js_var_object.current_link + "/" + $(this).val();

    });

    $('a#export_class').click(function(){
        location.href=js_var_object.controller_link+"/export/"+ $('#select_bus').val();
    });

    $('a#import_class').click(function(){

        $("#import_dialog").dialog("open");


    });


    $( '#import_form' ).submit( function( e ) {
        $.ajax( {
            url:  $('#import_form').attr("action"),
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


    $('#add_to_bus').click(function () {
        var all_student = [];
        var students_inbus = [];
        $.each($('select[name="bus_students_helper1"] option '), function (x, y) {
            all_student.push($(this).val());
        });
        $.each($('select[name="bus_students_helper2"] option '), function (x, y) {
            students_inbus.push($(this).val());
        });

        var data = {bus:$('#select_bus').val(), students_inbus:students_inbus};
        $.post(js_var_object.current_link, {
            action:'distribute_students',
            data:JSON.stringify(data)
        }, function (result) {
            if (result.message != "failed") {
                toastr.success('Success   ');
            } else {
                toastr.error('Failed   ');
            }
        }, 'json');
    });

});


