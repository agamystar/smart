var for_upload;
var flage=true;
var count_error;
$(function () {



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

    }).on('change', function(){

        });


    $('.select_message').click(function(){

        $(this).parent().parent().removeClass("message-unread");

        $('#tt').tabs("close", 3);

        $('.message-body').html("<p style='line-height: 36px;font-size: 16px;'>"+$(this).attr("m_body")+"</p>");
        $('#m_date').html($(this).attr("m_date"));
        $('#m_photo').attr("src",js_site_link+"/assets/uploads/"+$(this).attr("m_photo"));
        $('#m_photo').attr("alt","m_from");
        $('#m_attachment').text($(this).attr("m_attachment"));
        $('#download_link1,#download_link2').attr("href",js_site_link+"/assets/uploads/"+$(this).attr("m_attachment"));
        $('#m_header').html($(this).attr("m_header"));

        $('#tt').tabs('add',{
            title:'Message Details ',
            content:$('#id-message-content').html(),
            closable:true,
            tools:[{
                iconCls:'icon-mini-refresh',
                handler:function(){
                    alert('refresh');
                }
            }]
        });

        $.post(js_var_object.current_link,{
            action:"read",
            m_id:$(this).attr("m_id")
        },function(){


        });

    });


    if(js_var_object.p_m_id){

        $('.select_message[m_id="'+js_var_object.p_m_id+'"]').trigger("click");
        //alert($('.select_message[m_id="'+js_var_object.p_m_id+'"]').html());
    }


    $('#send_message').click(function(){


        count_error=0;
        $.each($('#the_message input.required'),function(x,y){


                if( $(this).val()<1){
                    $(this).closest(".form-group").addClass('has-error');
                    count_error++;
                }

            }
        );

        if(count_error<1){

            $('.loading-indicator').show();
        $.post(js_var_object.current_link,{
            action:"add",
            m_to:$('#m_to').val(),
            m_header:$('#m_header').val(),
            m_body:$('#m_body').val()
        },function(result){

            if (result.message == "success") {
                toastr.success('  Success  ');
                location.href=js_var_object.current_link;
                $('.loading-indicator').hide();
            } else {
                toastr.error(result.message);
                $('.loading-indicator').hide();

            }
        },'json');


        }
    });


});


