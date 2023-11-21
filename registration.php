<?php
session_start();
require 'vendor/autoload.php';
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
    $fullname = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['fullname']));
    $matric = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['matric']));
    $department = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['department']));
    $course = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['course']));
    $mode = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['mode']));
    $graduation = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['graduation']));
    $entry = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['entry']));
    $select = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['select']));
    $marry = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['marry']));
    $email = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['email']));
    $phone = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['phone']));
    $level = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['level']));
    $date = $_POST['date_of_birth'];
    $newphone = "+234" . ltrim($phone, "0");
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
        $messageBird = new \MessageBird\Client('Eyp5oSzTr5yZYlXXVk5yXEK3n');
        $message = new \MessageBird\Objects\Message();
        try {
            $message->originator = "+2347016409616";
            $message->recipients = [$newphone];
            $message->body = "Dear " . $fullname . " you have Succesfully Updated your Information, Please go to Login page and Use your Jamb/Matric No, Email and your Phone Number as Password to print your Application Summary. Take the Application Summary to the NASSA Office. Thank You from Abraham";
            $reponse = $messageBird->messages->create($message);
            if ($reponse) {
                echo "
                alert('An SMS has been sent to your Phone Number');
                ";
            }
        } catch (Exception $e) {}
        QRcode::png($qrdata, $file);
        move_uploaded_file($tmp_name_pass, $file_location1);
        move_uploaded_file($tmp_name_sign, $file_location2);
        $sql = "UPDATE userdata SET name = '$fullname',jamb_reg = '$matric',department = '$department', address = '$address', course = '$course',mode_of_entry = '$mode',graduation_year = '$graduation',year_of_entry = '$entry', current_level='$level',gender = '$select',marital_status = '$marry',email_address  = '$email',phone_no = '$phone',signature = '$sign',photo = '$pass',date_of_birth = '$date',status = 1, qr_code = '$file' where jamb_reg='$matric' or id='$id'";
        $query = mysqli_query($connection, $sql);
        if ($query) {
            $_SESSION['query'] = $query;
            echo '<script>
            window.setTimeout(function() {
    window.location.href = "login/login.php";
}, 5000);
            </script>';

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
        <title>Welcome <?php echo $data['name']; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="user/css/styles.css" rel="stylesheet" />
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color:#5043A0
;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 font-weight-bold text-white" href="registration.php">FNAS NSUK</a>
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
                    <ul class="dropdown-menu dropdown-menu-end font-weight-bold text-white" aria-labelledby="navbarDropdown">
                        <form action="logout.php" method="post">
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
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading font-weight-bold text-white">Menu</div>
                            <a class="nav-link font-weight-bold text-white" href="registration.php">
                                <div class="sb-nav-link-icon font-weight-bold text-white"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer text-white" style="background-color:#6B5BBE
">
                        <div class="small text-white font-weight-bold"> You are Now Logged in as:</div>
                        <?php echo $data['name']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 shadow-lg mx-10">
                <h3 class="mt-4"> Welcome to FNAS NSUK,  <?php echo $data['name'] . " | " . $data['jamb_reg']; ?></h3>
                        <marquee><p><b>Being in Faculty of Natural and Applied Science is never a regret...</b></p> </marquee>

                       <?php
$quote = array(
    "Change is the end result of all true learning. – Leo Buscaglia",
    "Education is the passport to the future, for tomorrow belongs to those who prepare for it today. – Malcolm X",
    " An investment in knowledge pays the best interest. –  Benjamin Franklin",
    " The roots of education are bitter, but the fruit is sweet. – Aristotle",
    "Education is what remains after one has forgotten what one has learned in school. – Albert Einstein",
    "The more that you read, the more things you will know, the more that you learn, the more places you’ll go.”– Dr. Seuss",
    "“Live as if you were to die tomorrow. Learn as if you were to live forever.” ― Mahatma Gandhi",
    "“Education without values, as useful as it is, seems rather to make man a more clever devil.” ― C.S. Lewis",
    "“The learning process continues until the day you die.” – Kirk Douglas ",
);
$random = array_rand($quote);
echo '<p>';
echo "<b>Quote of the Day - ";
echo $quote[$random] .
    '</b></p>';
?>

                    <div class="row my-5">
  <div class="col-md-4 my-2">
      <form class="shadow-sm " action="registration.php" method="post" enctype="multipart/form-data">
      <label for="name">Full Name</label>
    <input type="text" class="form-control" required  name ="fullname" readonly placeholder="First name" value="<?php echo $data['name']; ?>" aria-label="First name">
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Jamb Reg No/Matric No</label>
    <input type="text" class="form-control" required  name ="matric" value="<?php echo $data['jamb_reg']; ?>" placeholder="Last name" >
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Department</label>
    <input type="text" class="form-control" readonly required name ="department" value="<?php echo $data['department']; ?>">
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Course of Study</label>
    <input type="text" class="form-control" readonly required  name ="course" value="<?php echo $data['course']; ?>" placeholder="Couse of Study" >
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Mode of Entry</label>
    <input type="text" class="form-control" required readonly  name ="mode" value="<?php echo $data['mode_of_entry']; ?>" placeholder="Mode of Entry" aria-label="Mode of Entry">
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Year of Graduation</label>
    <input type="text" class="form-control" required   name ="graduation" value="<?php echo $data['graduation_year']; ?>" placeholder="Year of Graduation" >
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Year of Entry</label>
    <input type="text" class="form-control" required  name ="entry" value="<?php echo $data['year_of_entry']; ?>" placeholder="Year of Entry" >
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Gender</label>
    <select name="select" class="form-select" required >
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Marital Status</label>
    <select name="marry" class="form-select" required >
        <option value="Single">Single</option>
        <option value="Married">Married</option>
    </select>
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Email Address</label>
         <div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping">@</span>
  <input type="text" class="form-control" required  name ="email" value="<?php echo $data['email_address']; ?>" placeholder="fnasnsuk@example.com">
</div>
  </div>
  <div class="col-md-4 my-2">
         <label for="name">Phone Number</label>
         <div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping"><i class="fa fa-phone" style="font-size:15px"></i></span>
  <input type="text" class="form-control" required name="phone" value="<?php echo $data['phone_no']; ?>" placeholder="Phone Number">
</div>
  </div>
  <div class="col-md-4 my-2">
       <label for="sign">Upload Your Signature(Max: 500KB)</label>
  <input class="form-control" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please Upload your Signature')"  name ="sign" type="file" id="formFile">
</div>
  <div class="col-md-4 my-2">
       <label for="pass">Upload Your Passport (Max: 500KB)</label>
  <input class="form-control" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please Upload your Passport')" name ="pass" type="file" id="formFile">
</div>
  <div class="col-md-4 my-2">
       <label for="date">Date of Birth</label>
  <input type="date" class="form-control"  name="date_of_birth" required value = <?php echo $data['date_of_birth']; ?>  id="">
</div>
  <div class="col-md-4 my-2">
       <label for="address">Contact Address</label>
  <input type="text" class="form-control" required name="address" value="<?php echo $data['address']; ?>">
</div>
<div class="col-md-4 my-2">
         <label for="name">Current Level</label>
    <select name="level" class="form-select" required >
        <option value="100L">100L</option>
        <option value="200L">200L</option>
        <option value="300L">300L</option>
        <option value="400L">400L</option>
        <option value="500L">500L</option>
    </select>
  </div>
<div class="col-md-4 my-2">
    <input type="hidden" class="form-control" required  name ="id" value="<?php echo $data['id']; ?>" placeholder="ID" >
  </div>
<button class="btn btn-primary w-50 my-5 m-auto text-center" name="save" type="submit">Save</button>
</form>
</div>
                    </div>
                </main>
                <?php
if (isset($_SESSION['query'])) {
    echo '<script>
    swal({
  title: "Success",
  text: "Your Information has been Saved Successfully. You will be redirected to Login Page in Five Second ",
  icon: "success",
  timer: 4800,
  button: "OK",
});
    </script>';
    unset($_SESSION['query']);
}
?>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid ">
                        <div class="d-flex align-items-center justify-content-between small">
                             <div class="text-muted tex-center">Copyright &copy; FNAS NSUK <?php echo date("Y"); ?></div>
                            <div>
                                <p> Today is <?php echo date("l, jS \of F, Y") . ", the Time is " . date("H:ia"); ?>
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
