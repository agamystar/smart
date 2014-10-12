var loading=false;
$(function(){


   // alert(JSON.stringify(js_var_object.teachers));

    $('#select_teacher').change(function(){
        location.href=js_var_object.current_link+"/"+$(this).val();
    });



    $('#select_class').combotree({
        url: js_var_object.current_link+"?action=load_classes",
        multiple:true,
        checkbox:true,
        onSelect: function(node){

        },
        onLoadSuccess:function(node){
            loading=true;

        }
    });

    $('#send_homework').click(function(){

        $.post(js_var_object.current_link,{
            action:"add",
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


});