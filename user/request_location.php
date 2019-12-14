<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {
    function test_input($data, $conn)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }


    $name  = $description =  "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $flag = 0;
        $user = $_SESSION['user_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $extension = end(explode(".", $image));
        $newfilename = $name . "." . $extension;
        $target = "../images/location/" . $newfilename;
        $select_query = "SELECT name FROM locations";
        $result = mysqli_query($conn, $select_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $row_name = strtolower($row['name']);
            if ($row_name == strtolower($name)) {
                $error = "Location already exists";
                $flag = 1;
            }
        }
        if (
            empty($name) || empty($description) || empty($image)
        ) {
            $error = "Please fill all the details";
            $flag = 1;
        } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $flag = 1;
            $error = "Only letters and white space allowed";
        }
        if ($flag == 0) {
            $description = test_input($description, $conn);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $sql = "INSERT INTO locations (name, description, approved, requested_user, image) 
        VALUES ('$name', '$description', 0, $user, '$target')";
            if (mysqli_query($conn, $sql)) {
                echo '<script type="text/javascript">
                    window.location = "request_location_success.php"
                    </script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/style.css"> -->
    <title>Know Your Destination - Request a location</title>

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
                    <li><a href="locations.php">Locations</a></li>
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

            <div class="container col-md-6 rounded mt-5 p-4 bg-white">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div align="center">
                        <h2> Request a location</h2>
                    </div>
                    <div class="form-group mt-5">
                        <label class="col-md-6 ">Location name:</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 ">Location description:</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Location image</label><br>
                        <input type="file" name="image" id="image">
                    </div>
                    <br>
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
                    <br>
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