<?php include 'connect.php' ?>
<?php

session_start();
$username = $password = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $flag = 0;
    $error = "";
    if (
        empty($username) || empty($password)
    ) {
        $flag = 1;
        $error = "Fields can't be empty";
    }
    if (!$flag) {
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                echo '<script type="text/javascript">
                    window.location = "locations.php"
                     </script>';
                echo "Success";
            } else {
                $flag = 1;
                $error = "Check your credentials";
            }
        } else {
            $flag = 1;
                $error = "Check your credentials";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Signin</title>
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
          <li class="menu-active"><a href="./index1.php">Home</a></li>
          <li><a href="../admin/">Sign in as Admin</a></li>
          <li><a  href="../businessadmin/">Add your business</a></li>
          
          <li><a href="./signup.php">Sign up</a></li>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <main id="main">

<!--==========================
  About Us Section
============================-->
<section id="about" class="mt-5">
    
    <div class="container col-md-6 rounded mt-5 p-4 bg-white">
        <form action="" method="POST">
            <div align="center">
                <h2>User Signin</h2>
            </div>
            <div class="form-group">
                <label class="col-md-6 ">Username:</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="form-group">
                <label class="col-md-6 ">Password:</label>
                <input type="password" name="password" class="form-control">
            </div>
            <?php
            if ($flag) { ?>
                <div align="center" class=" text-danger">
                    <?php echo $error ?>
                </div>
            <?php
            }
            ?>
            <div align="center">
                <input type="Submit" value="Submit" class="btn  btn-dark w-100">
            </div>
        </form>
    </div>

</section>
  </main>

  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>Know your destination</h3>
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
</body>

</html>