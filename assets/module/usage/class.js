$(function () {

    $('#select_class').change(function () {

        window.location = js_var_object.current_link + "/" + $(this).val();

    });

    $('#add_to_class').click(function () {
        var all_student = [];
        var students_inclass = [];
        $.each($('select[name="class_students_helper1"] option '), function (x, y) {
            all_student.push($(this).val());
        });
        $.each($('select[name="class_students_helper2"] option '), function (x, y) {
            students_inclass.push($(this).val());
        });

        var data = {class:$('#select_class').val(), students_inclass:students_inclass};
        $.post(js_var_object.current_link, {
            action:'distribute_students',
            data:JSON.stringify(data)
        }, function (result) {
            if (result.message == "success") {
                toastr.success('Successfully Added  ');
            } else {
                toastr.error('Failed   ');
            }
        }, 'json');
    });

});


