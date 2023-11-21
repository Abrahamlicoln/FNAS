<?php
include '../../php_code/connection.php';
if (isset($_POST['delete2'])) {
    $stud = $_POST['student_id'];
    $sql = "DELETE FROM officials where id='$stud'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        echo "Official Record Deleted Successfully";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "president.php";
}, 4000);
            </script>';

    }
}
