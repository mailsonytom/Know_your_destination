<?php include 'connect.php' ?>
<?php
session_start();
if (isset($_SESSION['business_user'])) {
  include 'logout.php';
}
$username = $password = $error_text = "";
$error_flag = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_POST['username'];
  $password = $_POST['password'];
  if (
    empty($username) || empty($password)
  ) {
    $error_flag = 1;
    $error_text = "Fields can't be empty";
  } else if (!filter_var($username, FILTER_VALIDATE_EMAIL, $username)) {
    $error_flag = 1;
    $error_text = "Not a valid email";
  }
  if (!$error_flag) {
    $sql = "SELECT * FROM business WHERE email = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
      if (!$row['approved']) {
        $error_flag = 1;
        $error_text = "Busness not approved. Contact Admin.";
      } else if (password_verify($password, $row['password'])) {
        $_SESSION['business_user'] = $row['id'];
        echo '<script type="text/javascript">
					window.location = "dashboard.php"
					 </script>';
      } else {
        $error_flag = 1;
        $error_text = "Invalid credentials.";
      }
    } else {
      $error_flag = 1;
      $error_text = "Invalid credentials.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Know Your Destination</title>
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

<body style="background-image: url('../assets/img/biz-bg.jpg'); background-size: cover;">

  <!--==========================
    Header
  ============================-->
  <header id="header" class="header-black">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto">Know Your Destination</a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="../user/signin.php">User</a></li>
          <li><a href="../admin/">Admin</a></li>
          <li><a href="./signup.php">Sign up</a></li>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
  <div class="container col-md-6  rounded mt-5 p-4 " style="height: 90vh">
    <form action="" method="POST" class="mt-5 bg-dark rounderd p-4" style="border-radius: 20px; color: #fff;">
      <div align="center">
        <h2> Business Sign in</h2>
      </div>
      <div class="form-group mt-5">
        <label class="col-md-6 ">Email:</label>
        <input type="text" name="username" class="form-control" placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label class="col-md-6 ">Password:</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password">
      </div>
      <?php
      if ($error_flag) { ?>
        <div align="center" class=" text-danger">
          <?php echo $error_text ?>
        </div>
      <?php
      }
      ?>


      <div align="center">
        <input type="Submit" value="Submit" class="btn  btn-primary w-100">
      </div>
    </form>

  </div>

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