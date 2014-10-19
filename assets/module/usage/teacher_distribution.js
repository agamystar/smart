var loading=false;
$(function(){

    $('input[name="teachers"]:first').attr("checked","");
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

            $.ajax( {
                url:js_var_object.current_link,
                beforeSend : function() {

                    var nodes = $('#select_class').tree('getChecked');

                    $.each(nodes,function(x,y){
                        $('#select_class').tree('remove', y.target);
                    });
               $('.loading-indicator').show();
                },
                complete : function(result) {


                }, success : function(result) {
                   $('.loading-indicator').hide();
                    var  resultObj = eval (result);
                    // alert( resultObj );

                    $.each(resultObj,function(x,yy){
                       // alert(yy.class_id);
                        var myNode = $('#select_class').tree('find',yy.class_id);
                        $('#select_class').tree('check', myNode.target);
                    });



                },
                type: 'POST',
                data:{
                    action:'get_teacher_classes',
                    teacher:  $('input[name="teachers"]:checked').val()
                }
                // ,dataTypes:'JSON'
            } );


        }
    });




    $('input[name="teachers"]').change(function(){

        $('#select_class').tree('reload');


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
