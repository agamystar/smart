
$(function () {
    Dropzone.options.myAwesomeDropzone = {
        maxFiles: 1,
        accept: function(file, done) {
            console.log("uploaded");
            done();
        },
        init: function() {
            this.on("maxfilesexceeded", function(file){
                alert("No more files please!");
            });
        }
    };

   $('#edit_profile').click(function(){

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


        $.post( js_var_object.current_link,
            {
                action:"",
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


