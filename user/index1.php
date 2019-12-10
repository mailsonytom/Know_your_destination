<?php include 'connect.php' ?>
<?php
session_start();


$sql = "SELECT * from locations WHERE approved = 1 LIMIT 3";

$result = mysqli_query($conn, $sql);
while ($aLocation = mysqli_fetch_assoc($result)) {
  $locations[] = $aLocation;
}
$sql = "SELECT * from business B WHERE B.approved = 1 LIMIT 3";
$result = mysqli_query($conn, $sql);
while ($aBusiness =  mysqli_fetch_assoc($result)) {
  $businesses[] = $aBusiness;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>BizPage Bootstrap Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

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

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto">Know Your Destination</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="./locations_guest.php">Locations</a></li>
          <!-- <li><a href="./business.php">Businesses</a></li> -->
          <li><a href="#contact">Contact</a></li>
          <li><a href="./signin.php">Login</a></li>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item active">
            <div class="carousel-background"><img src="../assets/img/intro-carousel/1.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Get your vacations super amazing.</h2>
                <p>Around the world, destinations are waiting for your footfall. Don't think twice for your dream destination.</p>
                <a href="signin.php" class="btn-get-started scrollto">Get Started</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>Locations</h3>
          <p>The exotic locations for your vacation. Impress everyone around you and invoke your inner soul. Dream destinations.</p>
        </header>

        <div class="row about-cols">
          <?php foreach ($locations as $a) { ?>
            <div class="col-md-4 wow fadeInUp">
              <div class="about-col">
                <div class="img">
                  <img src="<?php echo $a['image'] ?>" alt="" class="img-fluid">
                  <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
                </div>
                <h2 class="title"><a href="#"><?php echo $a['name'] ?></a></h2>
                <p>
                  <?php echo $a['description'] ?>
                </p>
              </div>
            </div>

          <?php } ?>
          <div class="m-auto">

            <a href="./locations_guest.php" class="kyd-btn-get-started scrollto">Explore more</a>
          </div>

        </div>

      </div>
    </section><!-- #about -->



    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeIn">
      <div class="container text-center">
        <h3>Login to book</h3>
        <p> Login to create the best expreience of your life. Your dream destination is waiting for you. </p>
        <a class="cta-btn" href="./signin.php">Login Now</a>
      </div>
    </section><!-- #call-to-action -->


    <!--==========================
      Facts Section
    ============================-->
    <section id="facts" class="wow fadeIn">
      <div class="container">

        <header class="section-header">
          <h3>What we do</h3>
          <p>We create the best vacations of your lifetime</p>
        </header>

        <div class="row counters kyd-facts">

          <div class="col-lg-4 col-6 text-center ">
            <span data-toggle="counter-up">10</span><span>+</span>
            <p>Locations</p>
          </div>

          <div class="col-lg-4 col-6 text-center">
            <span data-toggle="counter-up">50</span><span>+</span>
            <p>Businesses</p>
          </div>

          <div class="col-lg-4 col-6 text-center">
            <span data-toggle="counter-up">1000</span><span>+</span>
            <p>Bookings</p>
          </div>



        </div>



      </div>
    </section><!-- #facts -->

    <!--==========================
      Portfolio Section
    ============================-->
    <section id="portfolio" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">Businesses with us</h3>
        </header>

        <div class="row portfolio-container">
          <?php foreach ($businesses as $a) { ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">
              <div class="portfolio-wrap">
                <figure>
                  <img src="<?php echo $a['image'] ?>" class="img-fluid" alt="">
                  <a href="img/portfolio/app1.jpg" data-lightbox="portfolio" data-title="App 1" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="#"><?php echo $a['name'] ?></a></h4>
                  <p><?php echo $a['description'] ?></p>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>

      </div>
    </section><!-- #portfolio -->


    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Contact Us</h3>
          <p>Get in touch with us for the best destinations for your dream travel !! </p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>A108 Adam Street, NY 535022, USA</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">info@kyd.com</a></p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #contact -->

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