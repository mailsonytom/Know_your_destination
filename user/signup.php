<?php include 'connect.php' ?>
<?php
$name = $username = $password = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $flag = 0;
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $select_query = "SELECT * FROM users";
  $result = mysqli_query($conn, $select_query);
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['username'] == $username) {
      $flag = 1;
      $error = "User already exists";
    }
  }
  if ($flag == 0) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, username, password, phone, email, address) VALUES ('$name', '$username', '$password', '$phone', '$email', '$address')";
    if ($conn->query($sql) === TRUE) {
      echo '<script type="text/javascript">
                    window.location = "signin.php"
                    </script>';
    } else {
      $flag = 1;
      $error = "Unable to sign up";
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Know Your Destination - User signup</title>

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
        <h1><a  class="scrollto">Know Your Destination</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="./index1.php">Home</a></li>
          <li><a href="../admin/">Admin</a></li>
          <li><a  href="../businessadmin/">Business</a></li>
          
          <li><a href="./signin.php">Sign in</a></li>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <main id="main">

    <!--==========================
  About Us Section
============================-->
    <section id="about" class="mt-5">
      <div class="container col-md-6 rounded bg-white mt-5 p-4">
        <form action="" method="POST">
          <div align="center">
            <h2>User Signup</h2>
          </div>
          <div class="form-group">
            <label class="col-md-6 ">Name:</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label class="col-md-6 ">Email:</label>
            <input type="text" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label class="col-md-6 ">Phone:</label>
            <input type="text" name="phone" class="form-control">
          </div>
          <div class="form-group">
            <label class="col-md-6 ">Address:</label>
            <input type="text" name="address" class="form-control">
          </div>
          <div class="form-group">
            <label class="col-md-6 ">Username:</label>
            <input type="text" name="username" class="form-control">
          </div>

          <div class="form-group">
            <label class="col-md-6 ">Password:</label>
            <input type="Password" name="password" class="form-control">
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

</body>

</html>