$(function () {

var loading=false;
    $('#select_class').combotree({
        url: js_var_object.current_link+"?action=load_classes",
        editable:false,
        onSelect: function(node){
            if(node.id>0 && loading==true){
               window.location = js_var_object.current_link + "/" +node.id;
               // alert("select");
            }
        },
        onLoadSuccess:function(node){
            loading=true;
        }
    }).combotree("setValue",js_var_object.p_class);


    $('.class_students').bootstrapDualListbox({
        nonSelectedListLabel:'<span class="label label-success arrowed-in arrowed-in-right">All Students That not have classes </span>',
        selectedListLabel:'<span class="label label-success arrowed-in arrowed-in-right">All Student in This Class</span> ',
        preserveSelectionOnMove:'moved',
        moveOnSelect:false
        //  nonSelectedFilter:'ion ([7-9]|[1][0-2])'
    });

    $('#id-pills-stacked').removeAttr('checked').on('click', function(){
        $('.nav-pills').toggle();
    });
    $("#import_dialog").dialog({
        width:500,
        autoOpen:false,
        modal: true,
        closed: true,
        title:'Import Form'
    });


    $('#import_form').attr("action",js_var_object.controller_link+"/import/"+ $('#select_class').combotree("getValue"));


    $('a#export_class').click(function(){
        location.href=js_var_object.controller_link+"/export/"+ $('#select_class').combotree("getValue");
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


    $('#add_to_class').click(function () {
        var all_student = [];
        var students_inclass = [];
        $.each($('select[name="class_students_helper1"] option '), function (x, y) {
            all_student.push($(this).val());
        });
        $.each($('select[name="class_students_helper2"] option '), function (x, y) {
            students_inclass.push($(this).val());
        });

        var data = {class: $('#select_class').combotree("getValue"), students_inclass:students_inclass};
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


