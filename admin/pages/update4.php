
<?php
session_start();
include '../../php_code/connection.php';
if (isset($_POST['update4'])) {
    $id = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['id']));
    $fullname = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['fullname']));
    $position = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['position']));
    $email = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['email']));
    $phone = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['phone']));
    $course = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['course']));
    $level = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['level']));
    $update = "UPDATE officials SET fullname='$fullname',position='$position',email='$email',phone='$phone',courseofstudy='$course',level='$level' WHERE id='$id'";
    $query = mysqli_query($connection, $update);
    if ($query) {
        echo "You have Successfully Updated the Official Information";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "president.php";
}, 4000);
            </script>';
    } else {
        $_SESSION['update_error'] = "Update Failed";
    }
}
