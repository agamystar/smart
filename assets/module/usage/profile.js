
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
                    url: 'http://localhost/system/user/upload',
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (returndata) {
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

        alert($('input[name="user_image"]').val());
       $('span.editable').each(function(index, obj){
           $(obj).replaceWith($('<input type=text>').attr({ id: $(obj).attr("id"), value: $(obj).text(),class:"editable" }));
       });

       $(this).hide();
       $("#update_profile").show();

   });

    $('#update_profile').click(function(){

        var addnewrow = {
            name:$('#name').val(),
            national_id:$('#national_id').val(),
            email:$('#email').val(),
            groups:$('#group').val(),
            username:$('#username').val(),
            password:$('#password').val(),
            id:$('#user_id').val(),
            phone:$('#phone').val(),
            photo:$('#photo').val(),
            birthday:$('#birthday').val(),
            sex:$('#sex').val(),
            religion:$('#religion').val(),
            blood_group:$('#blood_group').val(),
            address:$('#address').val(),
            id:$('#kid').val()


        };


        $.post( js_var_object.current_link+"/profile",
            {
                action:"update_profile",
                row_add:JSON.stringify(addnewrow)
            }, function (result) {
                if (result.result == "success") {
                    toastr.success('User Created Successfully  ');//Success Info Warning Error

                    $('.loading-indicator').hide();
                    $("#mymodal").dialog("close");
                } else {
                    toastr.error('Failed Process  ');//Success Info Warning Error

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


