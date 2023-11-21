<?php
session_start();
include '../../php_code/connection.php';
if (isset($_POST['save'])) {
    $fullname = $_POST['fullname'];
    $matric = $_POST['matric'];
    $department = $_POST['department'];
    $course = $_POST['course'];
    $update = "UPDATE userdata SET name='$fullname',department='$department',course='$course' WHERE jamb_reg='$matric'";
    $query = mysqli_query($connection, $update);
    if ($query) {
        echo "You have Successfully Updated the Student Information";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "table.php";
}, 4000);
            </script>';
    } else {
        $_SESSION['update_error'] = "Update Failed";
    }
}
