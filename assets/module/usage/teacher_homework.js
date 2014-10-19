var loading=false;
var flage=true;
$(function(){



   // alert(JSON.stringify(js_var_object.teachers));

    $('#select_teacher').change(function(){
        location.href=js_var_object.current_link+"/"+$(this).val();
    });



    $('#select_class').combotree({
        url: js_var_object.current_link+"?action=load_classes",
        multiple:true,
        height:30,
        checkbox:true,
        onSelect: function(node){

        },
        onLoadSuccess:function(node){
            loading=true;

        }
    });






    $('#send_homework').click(function(){
        $('.loading-indicator').show();

        var t = $('#select_class').combotree('tree');	// get the tree object
        var nodes = t.tree('getChecked');

        $.post(js_var_object.current_link,{
            action:"add",
            classes:JSON.stringify(nodes),
            h_header:$('#h_header').val(),
            h_body:$('#h_body').val()
        },function(result){

            if (result.result == "success") {
                toastr.success('  Success  ');//Success Info Warning Error

              location.href=js_var_object.current_link;
                $('.loading-indicator').hide();
            } else {
                toastr.error('Failed   ');//Success Info Warning Error

            }
        },'json');
    });

    $('#submit_send_homework').click(function(){

        $('.loading-indicator').show();

        $.post(js_var_object.current_link,{
            action:"add",
            m_body:$('#m_body').val(),
            m_header:$('#m_header').val(),
            m_to:$('#m_to').val()
        },function(result){
            if (result.result == "success") {
                toastr.success('  Success  ');//Success Info Warning Error
                $('.loading-indicator').hide();
                location.href=js_var_object.current_link;

            } else {
                toastr.error('Failed   ');//Success Info Warning Error

            }
        },'json');
    });

    $('#homework_form').dialog({
        modal: true,
        width:800,
        closed: true,
        title:'  ',
        height: 340,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
    });
    $('a#add_homework').click(function(){

        $('#homework_form').dialog("open");
    });

    $('#homework_reply_form').dialog({
        modal: true,
        width:800,
        closed: true,
        title:'  ',
        height: 280,
        cache: false,
        collapsible:true,
        minimizable:true,
        maximizable:true,
        resizable:true
    });
    $('a#send_homework_reply').click(function(){

        $('#homework_reply_form').dialog("open");
    });




    $('#id-input-file-3').ace_file_input({
        style:'well',
        btn_choose:'Drop files here or click to choose',
        btn_change:null,
        no_icon:'icon-cloud-upload',
        droppable:true,
        thumbnail:'fit',//large | fit|small
        //,icon_remove:null//set null, to hide remove/reset button
        before_change:function(files, dropped) {

            $('#loading').show();
            if(flage==true){
                $("#upload_form").submit(function(e){

                    var formData = new FormData($(this)[0]);

                    $.ajax({
                        url: js_site_url+"/security/files_upload/",
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

    })

});