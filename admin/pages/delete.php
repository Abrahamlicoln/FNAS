<?php
include '../../php_code/connection.php';
if (isset($_POST['delete'])) {
    $stud = $_POST['student_id'];
    $sql = "DELETE FROM userdata where id='$stud'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        echo "Student Record Deleted Successfully";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "table.php";
}, 4000);
            </script>';

    }
}
