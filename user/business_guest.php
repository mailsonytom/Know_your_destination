<?php include 'connect.php' ?>
<?php
session_start();

if (isset($_GET['id'])) {
  $index = $_GET['id'];
  $sql = "SELECT * from business B WHERE B.location_id = $index AND B.approved = 1";
  $result = mysqli_query($conn, $sql);
  while ($aBusiness =  mysqli_fetch_assoc($result)) {
    $businesses[] = $aBusiness;
  }
}
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Business signup</title>


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
        <h1><a href="#intro" class="scrollto">Know Your Destination</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class=""><a href="./index1.php">Home</a></li>
          <li><a href="locations_guest.php">Locations</a></li>
          <!-- <li><a  href="./mybookings.php">My bookings</a></li> -->
          
          <li><a href="./signin.php">Login</a></li>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
  <main id="main">
    <section id="about" class="section-bg mt-5">
      <div class="container col-md-8">
        <header class="section-header">
          <h3 class="section-title">Businesses</h3>
          <p>Select a business to book.</p>
        </header>

        <div class="row mt-4">
          <?php foreach ($businesses as $a) { ?>
            <a href="booking_guest.php?id=<?php echo $a['id'] ?>">
              <div class="col-md-4 wow fadeInUp">
                <div class="about-col">
                  <div class="img">
                    <img src="<?php echo $a['image'] ?>" alt="" class="img-fluid">
                    <!-- <div class="icon"><i class="ion-ios-speedometer-outline"></i></div> -->
                  </div>
                  <h2 class="title"><a href="#"><?php echo $a['name'] ?></a></h2>
                  <p class="text-center">
                    <?php echo $a['description'] ?>
                    <div class=" text-center font-weight-bold">&#x20B9; <?php echo $a['price'] ?></div>

                  </p>
                </div>
              </div>
            </a>

          <?php } ?>

        </div>
        <?php
        if (count($businesses) == 0) {
          echo "
                        <div align='center' class='text-secondary'>
                        <h3 >No approved business in this location</h3>
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
  <script src="../assets/lib/jquery/jquery.min.js"></script>
  <script src="../assets/lib/jquery/jquery-migrate.min.js"></script>
  <script src="../assets/lib/wow/wow.min.js"></script>
  <script src="../assets/lib/counterup/counterup.min.js"></script>



  <script src="../assets/js/main.js"></script>

</body>

</html>