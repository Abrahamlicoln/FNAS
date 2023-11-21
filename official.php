<?php include 'php_code/connection.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OFFICIALS | NASSA NSUK</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <link href="images/logo.png" rel="icon">
  <link href="images/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="asset/vendor/aos/aos.css" rel="stylesheet">
  <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="asset/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="asset/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="asset/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="asset/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>

  <!-- Template Main CSS File -->
  <link href="asset/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center">
        <img src="images/logo.png" alt="">
        <span>NASSA NSUK</span>
      </a>

      <nav id="navbar" class="navbar text-center">
        <ul>
          <li><a class="nav-link scrollto " href="index.php">Home</a></li>
          <li><a class="nav-link active"  href="official.php">Officials</a></li>
          <li><a class="nav-link scrollto" href="#services">Gallery</a></li>
          <li><a class="nav-link scrollto" href="contact/contactus.php">Contact Us</a></li>
          <li><a class="getstarted scrollto " href="login/index.php">SIGNUP</a></li>
          <li><a class="getstarted scrollto" href="login/login.php">LOGIN</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <!---officials Section Started---->


<style>
    .card:hover{
        box-shadow: 20px 20px 80px -44px #000;
        transition: .5s ease-in-out;
        cursor: pointer;
    }
    h2{
      color:blue;
    }
    .container{
      margin-top:150px;
    }
    .card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
}
.card-title{
  font-family: sans-serif;
  color:#0c3b87;
}
.card-text{
  font-weight: bold;
  color:#002c73;
}
h5{
  color:blue;
}

</style>

<body>

       <div class="container">
         <h2 class="text-center font-weight-bold">List of NASSA Officials</h2>
       </div>

       <div class="container mt-1 d-flex mb-5">
           <div class="row">
  <?php
$sql = "SELECT * FROM officials WHERE status='1'";
$query = mysqli_query($connection, $sql);
if ($query) {
    $numRow = mysqli_num_rows($query);
    if ($numRow > 0) {
        while ($row = mysqli_fetch_assoc($query)) {?>

            <div class="col-md-4 mt-5">
            <div class="card">
                <img style = "width:200px;" src="upload/<?php echo $row['photo']; ?>" class="card-img-top w-100"/>
                <div class="card-body">
                    <h5 class = "card-title font-weight-bold" >COMR. <?php echo ucwords($row['fullname']); ?></h5>
                     <h6 style="font-weight:bold; color:blue;"><?php echo $row['position']; ?></h6>
                    <div class="d-flex justify-content-between">

                        <p class="card-text"><?php echo $row['courseofstudy']; ?> (<?php echo $row['level']; ?>) </p>

                    </div>
                    <a href="#" class="card-link" data-toggle="modal" data-target="#modalId">View More</a>

                </div>

            </div>
            </div>
            <?php

        }

    }
}

?>

           </div>
       </div>

       <!-- Modal Code -->
     <div class="modal fade" id="modalId">
         <div class="modal-dialog bg-success">
             <div class="modal-content" style="transform: scaleX(1.4);">
                <div class="modal-header pb-2">
                    <h2 class="font-weight-bold ml-4 w-10">More About the Official</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-2 p-3">
                        <div class="col-md-6">
                            <img src="" width="100%" height="280px" class="rounded"/>
                        </div>
                        <div class="col-md-6">
                       <h2 class="product_name"></h2>
<p style="box-sizing: border-box; font-size:20px; font-weight:bold;" class="product_fullname"></p>
<p style="box-sizing: border-box; font-weight:bold;" class="product_desc"></p>

</div>

                    </div>

                </div>

             </div>

         </div>

     </div>

  <script>

     $(document).ready(function(){
   $(".card-link").click(function(){
   $(".rounded").attr("src",$(this).parent().siblings().attr("Src"));
   $(".product_fullname").text($(this).siblings("h5").text());
   $(".product_desc").text($(this).siblings("div").find("p:nth(0)").text());
   $(".product_price").text($(this).siblings("div").find("p:nth(1)").text());
   });
   $(window).resize(function (){
   if($(window).width() < 600){
   $(".modal-content").css("transform" , "scaleX(1)");
   }
   else{
    $(".modal-content").css("transform" , "scaleX(1.4)");
   }
   });
     });


  </script>



</body>

</html>
  <!---officials Section Ended---->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container-fluid">
      <div class="copyright">
        &copy; Copyright <?php echo date('Y'); ?> <strong><span>, NASSA NSUK</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">Cyberbotic Team, Nasarawa State Univeristy, Keffi</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="asset/vendor/purecounter/purecounter.js"></script>
  <script src="asset/vendor/aos/aos.js"></script>
  <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="asset/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="asset/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="asset/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="asset/vendor/php-email-form/validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <!-- Template Main JS File -->
  <script src="asset/js/main.js"></script>

</body>

</html>
