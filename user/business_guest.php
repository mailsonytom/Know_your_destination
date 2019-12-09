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
          
          <li><a href="./logout.php">Logout</a></li>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
  <main id="main">
  <section id="about"  class="section-bg mt-5" >
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
                if(count($businesses) == 0) {
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
            <h3>Knoy your destination</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">About us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Services</a></li>
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
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Know your destination</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
        -->
        Designed by TeamName
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