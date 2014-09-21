
$(function () {

   $('#edit_profile').click(function(){

       $('span.editable').each(function(index, obj){
           $(obj).replaceWith($('<input type=text>').attr({ id: $(obj).attr("id"), value: $(obj).text(),class:"editable" }));
       });

       $(this).hide();
       $("#update_profile").show();

   });

    $('#update_profile').click(function(){
        $('input.editable').each(function(index, obj){
            $(obj).replaceWith($('<span>').attr({class:$(obj).attr("class"), id: $(obj).attr("id")}).html($(obj).val()));
        });
        $(this).hide();
        $("#edit_profile").show();
    })

});


