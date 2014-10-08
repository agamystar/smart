
$(function () {

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
        thumbnail:'fit',//large | fit|small
        //,icon_remove:null//set null, to hide remove/reset button
        before_change:function(files, dropped) {
            $("#upload_form").submit(function(e){
                $('.loading-indicator').show();
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: js_site_url+"/user/upload",
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (returndata) {
                      if(returndata.length<30){
                          toastr.success('Image Uploaded  Successfully  ');
                      }else{
                          toastr.error(returndata);
                      }
                        $('.loading-indicator').hide();
                    }
                });
                e.preventDefault();
                return false;
            });

            $('#submit_file').trigger("click");
            return true;
         }
        /**,before_remove : function() {
         return true;
         }*/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }

    }).on('change', function(){
          //  alert(JSON.stringify($(this).data('ace_input_files')));
           // alert($(this).data('ace_input_method'));
        });




    $('#edit_profile').click(function(){

       $('span.editable').each(function(index, obj){
           $(obj).replaceWith($('<input type=text>').attr({ id: $(obj).attr("id"), value: $(obj).text(),class:"editable col-xs-12" }));
       });

       $(this).hide();
       $("#update_profile").show();

   });

    $('#update_profile').click(function(){

        var addnewrow = {
            email:$('#email').val(),
            phone:$('#phone').val(),
            address:$('#address').val()

        };


        $.post( js_var_object.current_link+"/profile",
            {
                action:"edit",
                row:JSON.stringify(addnewrow)
            }, function (result) {
                if (result.result == "success") {
                    toastr.success(' Success  ');//Success Info Warning Error

                    $('.loading-indicator').hide();
                    $("#mymodal").dialog("close");
                } else {
                    toastr.error('Failed ... Try Again   ');//Success Info Warning Error

                }

                $('#datagrid').datagrid("reload");
            }, 'json'
        );


        $('input.editable').each(function(index, obj){
            $(obj).replaceWith($('<span>').attr({class:$(obj).attr("class"), id: $(obj).attr("id")}).html($(obj).val()));
        });
        $(this).hide();
        $("#edit_profile").show();
    })

});


