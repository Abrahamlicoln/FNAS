<?php
session_start();
include 'php_code/connection.php';
include 'phpqrcode/qrlib.php';
if (!isset($_SESSION['dash'])) {
    header("Location:login/index.php");
} elseif (isset($_SESSION['dash'])) {
    $dash = $_SESSION['dash'];
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
            if (!isset($_SESSION['query'])) {
                header("Location:registration.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Welcome Back <?php echo $dash['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="user/css/styles.css" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color:#5043A0
;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="registration.php">FNAS NSUK</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars font-weight-bold text-white"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 text-center shadow">
            <li class="nav-item dropdown text-center">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw font-weight-bold text-white"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <form action="logout2.php" method="post">
                        <button class="text-center w-100" style="border:none; background-color:white;" type="submit">Logout</button>
                    </form>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav" style="background-color: #5043A0


;" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <img style="margin-left:50px; border-radius:50px;" src="upload/<?php echo $dash['photo']; ?>" height="100" width="100">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading font-weight-bold text-white">Menu</div>
                        <a class="nav-link font-weight-bold text-white" href="registration2.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt font-weight-bold text-white"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link font-weight-bold text-white" href="prinout2.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-print font-weight-bold text-white"></i></div>
                            Application Summary
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="sb-sidenav-footer text-white" style="background-color:#6B5BBE
">
                        <div class="small text-white font-weight-bold"> You are Now Logged in as:</div>
                        <?php echo $dash['name']; ?>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 shadow-lg">
                    <h3 class="mt-4  "></h3>
                    <div class="wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-lg-12" id="printArea">
                                                <div style="text-align:center" class="my-3">
                                                    <span style="float:left"> <img src="images/logo.png" style="width:150px;"> </span>
                                                    <span class="my-5" style="text-align:center;">
                                                        <h4>Faculty of Natural and Applied Science Student Association</h4>
                                                        <h4>Nasarawa State University, Keffi </h4>
                                                        <h4>Application Summary for Entry Year <?php echo $dash['year_of_entry']; ?></h4>
                                                    </span>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div style="background-image: url(images/logo.png);background-repeat:no-repeat;background-position: center;background-size:500px;background-blend-mode:overlay;margin-top:10px;">
                                                        <div style="opacity:2!important;background: rgba(255,255,255,0.8);">
                                                            <hr>
                                                            <table border="1" style="width:100%;border:1px solid black;border-collapse:collapse;padding:1em" class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="4" style="background:#5043A0; border:none;color:white;text-align:center;">
                                                                            APPLICATION DETAILS
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            MATRIC NO./JAMB REG. NO
                                                                        </td>
                                                                        <td>

                                                                            <b>
                                                                                <?php echo $dash['jamb_reg']; ?> </b>
                                                                        </td>
                                                                        <td></td>
                                                                        <td rowspan="5">
                                                                            <div>
                                                                                <center><img src="upload/<?php echo $dash['photo']; ?>" style="width:200px;"></center>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Full Name
                                                                        </td>
                                                                        <td>
                                                                            <?php echo strtoupper($dash['name']); ?> </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            Gender
                                                                        </td>
                                                                        <td>
                                                                            <?php echo ($dash['gender']); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Marital Status
                                                                        </td>
                                                                        <td>
                                                                            <?php echo ($dash['marital_status']); ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Date of Birth
                                                                        </td>
                                                                        <td>
                                                                            <?php echo date("l, jS \of F, Y", strtotime($dash['date_of_birth'])); ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Year of Entry </td>
                                                                        <td> <?php echo ($dash['year_of_entry']); ?></td>
                                                                        <td>Year of Graduation </td>
                                                                        <td> <?php echo ($dash['graduation_year']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Email </td>
                                                                        <td> <?php echo ($dash['email_address']); ?></td>
                                                                        <td>Phone Number </td>
                                                                        <td> <?php echo ($dash['phone_no']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Contact Address </td>
                                                                        <td> <?php echo ($dash['address']); ?></td>
                                                                        <td>Student Signature </td>
                                                                        <td>
                                                                            <center><img src="upload/<?php echo ($dash['signature']); ?>" width="100px" height="20px"></center>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <h4>School Details</h4>
                                                            <table border="1" style="width:100%;border:1px solid black;border-collapse:collapse;" class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            Mode of Entry
                                                                        </td>
                                                                        <td>
                                                                            <?php echo ($dash['mode_of_entry']); ?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Department
                                                                        </td>
                                                                        <td>
                                                                            <?php echo ($dash['department']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Course of Study
                                                                        </td>
                                                                        <td>
                                                                            <?php echo ($dash['course']); ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Current Level
                                                                        </td>
                                                                        <td>
                                                                            <?php echo ($dash['current_level']); ?></td>

                                                                    <tr>
                                                                        <td>
                                                                            Scan the QRCODE to Verify Student
                                                                        </td>
                                                                        <td>
                                                                            <center><img src="upload/<?php echo ltrim($dash['qr_code'], 'upload/'); ?>" style="width:200px; height:200px;"></center>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <center><button onclick="window.print()" class="btn btn-primary " style=" width:200px; margin-bottom:20px; background-color:#5043A0;">Print <i class="fa fa-print"></i></button></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--body wrapper end-->
                    </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted tex-center">Copyright &copy; FNAS NSUK <?php echo date("Y"); ?></div>
                        <div>
                            <p> Printed on <?php echo date("l, jS \of F, Y") . ",by " . date("H:ia"); ?>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="user/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>

</html>