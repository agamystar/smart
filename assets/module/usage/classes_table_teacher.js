$(function(){


    $.each(js_var_object.table_classes,function(x,y){
        $('.right tr[day="'+ y.day+'"] td[section="'+ y.section+'"] div.subj ').html('<div   class="subject assigned" >'+
            y.subject+'</div>');
        $('.right tr[day="'+ y.day+'"] td[section="'+ y.section+'"] div.teach ').html('<div value="'+y.teacher_id+'"' +
            ' class="teacher assigned" >'+
        y.class+'</div>');

        if(y.day==1 ){
            $('input[name="open_close_day"]').val('0');
            $('input[name="open_close_day"]').trigger("change");

        }else{
            $('input[name="open_close_day"]').val('1');
            $('input[name="open_close_day"]').trigger("change");

        }
    });



    $('#create_table').click(function(){
        var day_sections=[];
        $.each($('.right .subject'),function(){
            day_sections.push({
                "day":$(this).closest("tr").attr("day"),
                "section":$(this).closest("td").attr("section"),
                "subject":" "+ $(this).closest("td").find('.subject').html(),
                "teacher":" "+$(this).closest("td").find('.teacher').attr("value")
            });
        });
        $.post(js_var_object.current_link,{
                "action":"create_table",
                class_id: $('#select_class').combotree("getValue"),
                table:JSON.stringify(day_sections)
            },
            function (result) {
                if (result.message == "success") {
                    toastr.success('  Success  ');
                    $('.loading-indicator').hide();
                } else {
                    toastr.error('Failed   ');
                }
            },'json'

    );

});


    $('.subject,.teacher').draggable({
        revert:true,
        proxy:'clone'
    });
    $('.right .drop').droppable({
        onDragEnter:function(){
            $(this).addClass('over');
        },
        onDragLeave:function(){
            $(this).removeClass('over');
        },
        onDrop:function(e,source){
            $(this).removeClass('over');
            if ($(source).hasClass('assigned')){
                $(this).append(source);
            } else {
                var c = $(source).clone().addClass('assigned');
                $(this).empty().append(c);
                c.draggable({
                    revert:true
                });
            }
        }
    });
    $('.left').droppable({
        accept:'.assigned',
        onDragEnter:function(e,source){
            $(source).addClass('trash');
        },
        onDragLeave:function(e,source){
            $(source).removeClass('trash');
        },
        onDrop:function(e,source){
            $(source).remove();
        }
    });

});