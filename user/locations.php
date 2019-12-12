<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {

  $business_user_id = $_SESSION['business_user'];
  $sql = "SELECT * from locations WHERE approved = 1";

  $result = mysqli_query($conn, $sql);
  while ($aLocation = mysqli_fetch_assoc($result)) {
    $locations[] = $aLocation;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />
  <title>Know Your Destination - Locations</title>


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="../assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="../assets/css/theme.css" rel="stylesheet">
</head>

<body>
  <header id="header" class=" header-black">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="./index1.php" class="scrollto">Know Your Destination</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class=""><a href="./index1.php">Home</a></li>
          <li><a href="./request_location.php"> Request a Location</a></li>
          <li><a href="./mybookings.php">My bookings</a></li>

          <li><a href="./logout.php">Logout</a></li>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->


  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about" class="mt-5">
      <div class="container">

        <header class="section-header">
          <h3>Locations</h3>
          <p></p>
        </header>

        <div class="row about-cols">



          <?php foreach ($locations as $a) { ?>
            <a href="business.php?id=<?php echo $a['id'] ?>">
              <div class="col-md-4 wow fadeInUp">
                <div class="about-col">
                  <div class="img">
                    <img src="<?php echo $a['image'] ?>" alt="" class="img-fluid">
                    <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
                  </div>
                  <h2 class="title"><a href="business.php?id=<?php echo $a['id']; ?>"><?php echo $a['name']; ?></a></h2>
                  <p class="text-center">
                    <?php echo $a['description'] ?>
                  </p>
                </div>
              </div>
            </a>


          <?php } ?>


        </div>
        <?php
        if (count($locations) == 0) {
          echo "
                        <div align='center' class='text-secondary'>
                        <h3 >No approved locations in this location</h3>
                        </div>
                        ";
        }
        ?>
      </div>
    </section>
  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>Know your destination</h3>
            <p>Know your destination at travel offers both the independent traveller and packaged holidaymaker a vast range of holidays and cruises to destinations Worldwide. Don't wait for your dream journey to come to you. Travel towards your dream journey.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="../user/">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../admin/">Login as admin</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="../user/signin.php">User sign in</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@kyd.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Our newsletter is world famous for suggesting the best travel destinations available throughout the year. Subscribe to our newsletter for more !! </p>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Know your destination</strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by Team KYD
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="../assets/lib/jquery/jquery.min.js"></script>
  <script src="../assets/lib/jquery/jquery-migrate.min.js"></script>
  <script src="../assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/lib/easing/easing.min.js"></script>
  <script src="../assets/lib/superfish/hoverIntent.js"></script>
  <script src="../assets/lib/superfish/superfish.min.js"></script>
  <script src="../assets/lib/wow/wow.min.js"></script>
  <script src="../assets/lib/waypoints/waypoints.min.js"></script>
  <script src="../assets/lib/counterup/counterup.min.js"></script>
  <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="../assets/lib/lightbox/js/lightbox.min.js"></script>
  <script src="../assets/lib/touchSwipe/jquery.touchSwipe.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="../assets/contactform/contactform.js"></script>

  <script src="../assets/js/main.js"></script>


</body>

</html>