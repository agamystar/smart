$(function () {

    $.each(js_var_object.absence, function (y, x) {

        $('.itemdiv.dialogdiv > .user > img' + '#' + x.student_id).addClass("check_person");
    });



    $('#add').click(function () {
        var selection = [];
        $('.itemdiv.dialogdiv > .user > img.check_person').each(function (y, x) {
            selection.push($(this).attr('id'));
        });

        var data = {selection:selection,date:$('input.date').datebox("getValue"),bus: $('#select_bus').val()};
        $.post(js_var_object.current_link, {
            action:'add',
            data:JSON.stringify(data)
        }, function (result) {
            if (result.message != "failed") {
                toastr.success('Success   ');
            } else {
                toastr.error('Failed   ');
            }
        }, 'json');
    });

    $('#select_bus').change(function () {

        window.location = js_var_object.current_link + "?bus=" + $(this).val()+"&date="+$('input.date').datebox("getValue");

    });


    $('.itemdiv.dialogdiv > .user > img').click(function () {
        $(this).toggleClass('check_person');
    });


    $('input.date').datebox({
        height:30,
        width:200,
        onSelect:function (node) {

            var y= node.getFullYear();
            var m = node.getMonth() + 1;
            var d = node.getDate();

            var _date = (d < 10 ? '0' : '') + d + '/' +(m < 10 ? '0' : '') + m + '/' + y;

            window.location = js_var_object.current_link +"?bus="+ $('#select_bus').val()+"&date="+_date;


        }
    });

    $('input.date').datebox("setValue", js_var_object.p_date);

    $.each(js_var_object.absence, function (y, x) {

        $('.itemdiv.dialogdiv > .user > img' + '#' + x.user_id).addClass("check_person");
    });





});


