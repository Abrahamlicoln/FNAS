$(document).ready(function () {
    $('#add').click(function () {
        $('#insert').val("Insert");
        $('#insert_form')[0].reset();
    });
    $(document).on('click', '.edit_data', function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: { student_id: student_id },
            dataType: "json",
            success: function (data) {
                $('#matric').val(data.matric);
                $('#name').val(data.name);
                $('#department').val(data.department);
                $('#course').val(data.course);
                $('#mode').val(data.mode);
                $('#student_id').val(data.id);
                $('#insert').val("Update");
                $('#staticBackdrop').modal('show');
            }
        });
    });
    $('#insert_form').on("submit", function (event) {
        event.preventDefault();
        if ($('#name').val() == "") {
            alert("Student Name is Required");
        }
        else if ($('#department').val() == '') {
            alert("Student Department is Required");
        }
        else if ($('#course').val() == '') {
            alert("Student Course of Study is Required");
        }
        else {
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                beforeSend: function () {
                    $('#insert').val("Inserting");
                },
                success: function (data) {
                    $('#insert_form')[0].reset();
                    $('#staticBackdrop').modal('hide');
                    $('#student_table').html(data);
                }
            });
        }
    });
});  