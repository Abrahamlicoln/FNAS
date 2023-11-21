<?php session_start();?>
</html>
<?php
include '../php_code/connection.php';
if (isset($_POST['fetch'])) {
    $reg = $_POST['reg'];
    $error = "";
    $success = null;
    if (isset($reg)) {
        $fetch = "SELECT * FROM userdata where jamb_reg='$reg'";
        $query = mysqli_query($connection, $fetch);
        if ($query) {
            $fetch = "SELECT * FROM userdata where jamb_reg='$reg' and status = '0'";
            $query = mysqli_query($connection, $fetch);
            if ($query) {
                $numRow = mysqli_num_rows($query);
                if ($numRow > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['data'] = $row;
                        $data = $_SESSION['data'];
                        echo '<script>
            window.setTimeout(function() {
    window.location.href = "../registration.php";
}, 5000);
            </script>';
                    }
                } else {
                    $_SESSION['error'] = "Either your Record is not Found or you are not a Student of FNAS";
                    '<script>
            window.setTimeout(function() {
    window.location.href = "index.php";
}, 5000);
            </script>';

                }
            }
            $fetch = "SELECT * FROM userdata where jamb_reg='$reg' and status = '1'";
            $query = mysqli_query($connection, $fetch);
            if ($query) {
                $numRow = mysqli_num_rows($query);
                if ($numRow > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $_SESSION['message'] = $row;
                        echo '<script>
            window.setTimeout(function() {
    window.location.href = "login.php";
}, 5000);
            </script>';
                    }
                }
            }
        } else {

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to FNAS | NSUK</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <!------ Include the above in your HEAD tag ---------->

</head>

<body>
    <form action="index.php" method="post">
        <div class="container text-center">
            <div id="loginbox" style="margin-top:100px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <img src="../images/logo.png" width="125" height="90"><br>
                <h3 class="tex-center" style="color:white; font: weight 30px;;"> Welcome to FNAS NSUK CHAPTER</h3>
                <div class="panel panel-info">
                    <?php
if (isset($_SESSION['data'])) {
    echo '<script>
    swal({
  title: "Success",
  text: "Your Information Have Been Verified You will be Redirected to Registration Page in Five Second",
  icon: "success",
  timer: 4800,
  button: "OK",
});
    </script>';

} elseif (isset($_SESSION['message'])) {
    echo '<script>
    swal({
  title: "Information!",
  text: "You have already Updated your Information, You will be redirected to Login in 5 Seconds",
  icon: "info",
  timer: 4800,
  className: "text-center",
  button: "OK",
});
    </script>';
    unset($_SESSION['message']);
} elseif (isset($_SESSION['error'])) {
    echo '<script>
    swal({
  title: "Failed!",
  text: "Either your Record is not Found or You are not a Student of FNAS NSUK",
  icon: "error",
  timer: 4800,
  className: "text-center",
  button: "OK",
});
    </script>';
    unset($_SESSION['error']);

} else {

}
?>
<style>
    .swal-text{
        text-align: center;
        padding-top:3px;
    }
    </style>
                    <div class="panel-heading">
                        <div class="panel-title">Enter your Jamb Registration Number</div>
                    </div>

                    <div style="padding-top:30px" class="panel-body">
                        <form id="loginform" class="form-horizontal" role="form">

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
                                </span>
                                <input type="text" class="form-control" required oninput=" setCustomValidity('')" name="reg" oninvalid="this.setCustomValidity('Please Jamb Reg. No is required')" placeholder="Enter your Jamb Reg. No">
                            </div>
                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">
                                    <button type="submit" name="fetch" class="btn btn-success">Fetch Record</button>

                                </div>
                            </div>

                        </form>



                    </div>
                </div>
            </div>
        </div>

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
</form>
