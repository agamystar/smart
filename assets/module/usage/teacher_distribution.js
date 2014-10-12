var loading=false;
$(function(){


    $('#select_class').tree({
        url: js_var_object.current_link+"?action=load_classes",
        multiple:true,
       checkbox:true,
        panelHeight:600,
        onlyLeafCheck:$(this).is(':checked'),
        onSelect: function(node){

        },
        onLoadSuccess:function(node){
            loading=true;
            $('li ul li ul li').css({
                "display":"inline-flex",
                "width":"200px"
            });
        }
    });




    $('input[name="teachers"]').click(function(){

        alert(2);
        $.ajax( {
            url:js_var_object.current_link,
            beforeSend : function() {
             //   $('#select_class').tree({cascadeCheck:$(this).is(':checked')});
              //  $('.loading-indicator').show();
            },
            complete : function(result) {


            }, success : function(result) {

                var res=JSON.stringify(result);
                alert(res[0]);
                $.each(result,function(x,y){
                    var myNode = $('#select_class').tree('find',y.class_id);
                    alert(y.class_id);
                    $('#select_class').tree('check', myNode.target);
                });

                $('.loading-indicator').hide();

            },
            type: 'POST',
            data:{
                action:'get_teacher_classes',
                teacher: $(this).val()
            }
          // ,dataTypes:'JSON'
        } );



    });

    $('a#submit_distribute').click(function(){

        var n1 = $('#select_class').tree('getChecked');
        if(n1.length<1 || ! $('input[name="teachers"]').is(':checked') ){
            bootbox.alert("choose  classes and teacher ");
        }else{

            $('.loading-indicator').show();
            $.post(
                js_var_object.current_link,
                {
                    action:'distribute',
                    classes:JSON.stringify(n1),
                    teacher: $('input[name="teachers"]:checked').val()
                }, function (result) {
                    if (result.message == "success") {
                        toastr.success('successfully procedure ');//Success Info Warning Error

                    }
                    else{
                        toastr.error('Failed procedure ');//Success Info Warning Error
                           }
                    $('.loading-indicator').hide();
                }, 'json'
            );


        }
    });


});
