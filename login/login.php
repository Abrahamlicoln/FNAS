<?php
session_start();
include '../php_code/connection.php';
if (isset($_POST['submit'])) {
    $matric = htmlspecialchars($_POST['matric']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $sql = "SELECT * FROM userdata where jamb_reg='$matric' and email_address = '$username' and phone_no = '$password' and status = '1'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        $numRow = mysqli_num_rows($query);
        if ($numRow > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $_SESSION['dash'] = $row;
                echo '<script>
            window.setTimeout(function() {
    window.location.href = "../registration2.php";
}, 4000);
            </script>';

            }
        } else {
            $_SESSION['erro'] = "Incorrect Credential";
            echo '<script>
            window.setTimeout(function() {
    window.location.href = "login.php";
}, 4000);
            </script>';

        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../images/logo.png">
    <link rel="icon" type="image/png" href="../images/logo.png">
    <title>Login | FNAS NSUK</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet"/>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="assets/css/nucleo-icons.css" rel="stylesheet"/>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet"/>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet"/>

    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.min-v%3d1.0.1.css" rel="stylesheet"/>

    <link id="pagestyle" href="assets/css/animate.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />

    <script defer src="../unpkg.com/alpinejs%403.10.2/dist/cdn.min.js"></script>
</head>

<body class="g-sidenav-show  bg-white">

<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav
                class="navbar navbar-expand-lg  blur blur-rounded top-0  z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-uppercase" href="#" style="text-overflow: ellipsis; overflow: hidden">
                        FACULTY OF NATURAL AND APPLIED SCIENCE | NSUK
                    </a>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav mx-auto">
                            <!-- Optional links here -->
                        </ul>
                        <ul class="navbar-nav d-lg-block d-none">
                            <li class="nav-item">
                                <a href="../index.php" target="_blank" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">go   back</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>

<main class="main-content main-content-bg mt-0">
    <section>
        <div class="page-header section-height-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card shadow-lg mt-8 mb-4">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="db">
                                   <center> <img src="../images/logo.png" class="img-rounded" width="80" alt="Logo"/></center>
                                </h3>

                                <center><h4 class="font-weight-bolder text-info text-gradient">Faculty of Natural and Applied Science | NSUK</h4></center>
                            </div>


    <div x-data="{forgot: false}">

        <form action="login.php" method="post" >
            <div class="card-body">

                <center><p class="text-sm">Enter your Matric No./Jamb Reg. No, username and password to sign in</p></center>

                <label for="username">Matric No/Jamb Reg. No</label>
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="matric" placeholder="Enter your Jamb/Matric No."
                           aria-label="Username" required>
                </div>
                <label for="username">Email Address</label>
                <div class="mb-3">
                    <input type="email" class="form-control" id="username" name="username" placeholder="Enter your Email Address"
                           aria-label="Username" required>
                </div>

                <label for="password">Password</label>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control"
                           placeholder="Enter your Phone Number" aria-label="Password"
                           aria-describedby="password-addon" required>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                        Sign in <span style="display: none" class="spinner-border spinner-border-sm preloader" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </form>
    <?php
if (isset($_SESSION['dash'])) {
    echo "<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3800,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
</script>";
} elseif (isset($_SESSION['erro'])) {
    echo "<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3800,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title: 'Invalid Credentials'
})
</script>";

}
?>
    </div>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                    Copyright © <script>
                        document.write(new Date().getFullYear())
                    </script> FNAS,

                    <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2 text-info text-gradient">
                        NSUK
                    </a><br>
                    <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Powered By <span class="text-info text-gradient">Cyberbotic Team, NSUK</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!--   Core JS Files   -->
<script src="assets/js/core/vendor.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/soft-ui-dashboard.min-v%3d1.0.1.js"></script>

<!-- Custom JS -->
<script src="assets/js/bootstrap-notify3860.js?v=1"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/requestc619.js?v=1.0"></script>

<!-- Github buttons -->
<script async defer src="../buttons.github.io/buttons.js"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62a2164cb0d10b6f3e768856/1g54ie6us';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->



</body>
</html>
