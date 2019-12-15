<?php include 'connect.php' ?>
<?php
$category_name = $error_msg = "";
session_start();
session_start();
if (!isset($_SESSION['admin_user'])) {
    include 'logout.php';
} else {
    $sql = "SELECT * from categories";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $flag = 0;
        $category_name = $_POST['category_name'];
        $select_query = "SELECT * FROM categories";
        $result = mysqli_query($conn, $select_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $name = strtolower($row['name']);
            if ($name == strtolower($category_name)) {
                $flag = 1;
                $error_msg = "Category already exists.";
            }
        }
        if ($flag == 0) {
            $sql = "INSERT INTO categories (name) VALUES ('$category_name')";
            if (mysqli_query($conn, $sql)) {
                echo '<script type="text/javascript">
                    window.location = "category.php"
                    </script>';
            } else {
                $flag = 1;
                $error_msg = "Unable to add.";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Know your destination - Category</title>
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

<body style="background-image: url('../assets/img/about-bg.jpg'); background-size: cover;">

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
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->
    <nav class="navbar navbar-light bg-light mt-5 pt-5">
        <div class="m-auto ">
            <a href="business.php">
                <Button class="btn btn-light">
                    Business
                </Button>
            </a>
            <a href="locations.php">
                <Button class="btn btn-light">
                    Location
                </Button>
            </a>
            <a href="category.php">
                <Button class="btn btn-secondary">
                    Category
                </Button>
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-md-center mt-5 mb-5" style="color: #fff;">
            <div class="col-md-6 bg-dark mr-2 rounded pb-3">
                <div align="left" class="mt-3">
                    <h2> Categories</h2>
                </div>
                <div class="mt-3">
                    <?php foreach ($categories as $a) { ?>
                        <span class="badge badge-warning p-3 m-2"><?php echo $a['name'] ?>
                            <a href="delete_category.php?id=<?php echo $a['id']; ?>" class="text-dark"><b>X</b></a>
                        </span>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4 border-left border-dark bg-dark p-3">
                <form action="" method="post">
                    <div align="left">
                        <h2> Add New</h2>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Category Name:</label>
                        <input type="text" name="category_name" class="form-control">
                    </div>
                    <?php
                    if ($flag) { ?>
                        <div align="center" class=" text-danger">
                            <?php echo $error_msg ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div align="left">
                        <input type="Submit" value="Submit" class="btn  btn-secondary">
                    </div>
                </form>
            </div>

        </div>

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