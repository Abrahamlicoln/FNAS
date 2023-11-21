<?php
session_start();
include 'php_code/connection.php';
include 'phpqrcode/qrlib.php';
if (!isset($_SESSION['data'])) {
    header("Location:index.php");
} elseif (isset($_SESSION['data'])) {
    $data = $_SESSION['data'];
}
?>
<?php
if (isset($_POST['save'])) {
    $fullname = $_POST['fullname'];
    $matric = $_POST['matric'];
    $department = $_POST['department'];
    $course = $_POST['course'];
    $mode = $_POST['mode'];
    $graduation = $_POST['graduation'];
    $entry = $_POST['entry'];
    $select = $_POST['select'];
    $marry = $_POST['marry'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $level = $_POST['level'];
    $date = $_POST['date_of_birth'];
    $dates = date("Y-m-d", strtotime($date));
    $qrdata = "FULLNAME: " . $fullname;
    $qrdata .= "  MATRIC NO./JAMB REG. NO: " . $matric;
    $qrdata .= "  DATE OF BIRTH: " . strtoupper(date("l, jS \of F, Y", strtotime($date)));

    $qrdata .= "  DEPARTMENT: " . $department;
    $qrdata .= "  COURSE OF STUDY: " . $course;
    $qrdata .= "  GRADUATION YEAR: " . $graduation;
    $qrdata .= "  PHONE NUMBER: " . $phone;

    $id = $_POST['id'];
    $sign = $_FILES['sign']['name'];

    $tmp_name_sign = $_FILES['sign']['tmp_name'];
    $pass = $_FILES['pass']['name'];
    $tmp_name_pass = $_FILES['pass']['tmp_name'];
    $address = $_POST['address'];
    $error = "";
    $pass = uniqid("IMG-", true) . $pass;
    $sign = uniqid("IMG-", true) . $sign;
    $path = 'upload/';
    $file = $path . uniqid() . ".png";
    $file_location1 = "upload/" . $pass;
    $file_location2 = "upload/" . $sign;
    $image_extension1 = strtolower(pathinfo($pass, PATHINFO_EXTENSION));
    $image_extension2 = strtolower(pathinfo($sign, PATHINFO_EXTENSION));
    $extension = array("jpg", "png", "jpeg");
    if (empty($fullname) or empty($matric) or empty($department) or empty($course) or empty($mode) or empty($graduation) or empty($entry) or empty($select) or empty($marry) or empty($email) or empty($phone) or empty($date) or empty($address)) {
        $error = "One or More Field is Missing";
        if (empty($_FILES['pass']['name'])) {
            $_SESSION['error'] = "Please Upload your Passport";
        }
        if (empty($_FILES['sign']['name'])) {
            $_SESSION['error'] = "Please Upload your Signature";
        }
        if ($_FILES['pass']['size'] > 500000) {
            $error = "Passport Size Most not be more than 500KB";
        } elseif (in_array($image_extension1, $extension)) {
        } else {
        }
        if (empty($_FILES['sign']['name'])) {
            $_SESSION['error'] = "Please Upload your Signature";
        }
        if (empty($_FILES['sign']['name'])) {
            $_SESSION['error'] = "Please Upload your Signature";
        }
        if (file_exists($pass) && file_exists($sign)) {
            $error = "You have already Uploaded your Signature and Passport";
        }
        if ($_FILES['sign']['size'] > 500000) {
            $error = "Signature Size Most not be more than 500KB";
        } elseif (in_array($image_extension2, $extension)) {
        }
    } else {
        QRcode::png($qrdata, $file);
        move_uploaded_file($tmp_name_pass, $file_location1);
        move_uploaded_file($tmp_name_sign, $file_location2);
        $sql = "UPDATE userdata SET name = '$fullname',jamb_reg = '$matric',department = '$department', address = '$address', course = '$course',mode_of_entry = '$mode',graduation_year = '$graduation',year_of_entry = '$entry', current_level='$level',gender = '$select',marital_status = '$marry',email_address  = '$email',phone_no = '$phone',signature = '$sign',photo = '$pass',date_of_birth = '$dates',status = 1, qr_code = '$file' where jamb_reg='$matric' or id='$id'";
        $query = mysqli_query($connection, $sql);
        if ($query) {
            $_SESSION['query'] = $query;
            echo '<script>
            window.setTimeout(function() {
    window.location.href = "prinout.php";
}, 5000);
            </script>';

        }
    }
}
?>