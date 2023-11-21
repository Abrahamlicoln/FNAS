<?php
ob_start();
include '../../php_code/connection.php';
if (isset($_POST['deactive'])) {
    $student_id = $_POST['student_id'];
    $sql = "UPDATE officials SET status= '0' WHERE id = '$student_id'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        echo "You have Successfully Deactivated an official";
        header("Location:president.php");
    }
}
