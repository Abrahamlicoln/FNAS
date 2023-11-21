<?php
include '../../php_code/connection.php';
if (isset($_POST['active'])) {
    $student_id = $_POST['student_id'];
    $sql = "UPDATE officials SET status= '1' WHERE id = '$student_id'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        echo "You have Successfully Activated an official";
        header("Location:president.php");
    }
}
