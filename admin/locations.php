<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {
    if (isset($_GET['location_id'])) {
        $index = $_GET['location_id'];
        echo "location", $index;
        $sql = "UPDATE locations set approved = 1 WHERE id=$index";
        if (mysqli_query($conn, $sql)) {
            echo "success";
            echo '<script type="text/javascript">
                    window.location = "locations.php"
                    </script>';
        }
    }

    $admin_id = $_SESSION['admin_user'];

    $sql = "SELECT L.id, L.name, L.description, U.name as user_name, U.phone as user_phone, L.approved from locations L INNER JOIN users U on L.requested_user = U.id";

    $result = mysqli_query($conn, $sql);
    while ($aLocation = mysqli_fetch_assoc($result)) {
        if ($aLocation['approved'] == 0) {
            $non_approved_locations[] = $aLocation;
        } else {
            $approved_locations[] = $aLocation;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Know your destination - Locations</title>
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
                <Button class="btn btn-secondary">
                    Location
                </Button>
            </a>
            <a href="category.php">
                <Button class="btn btn-light">
                    Category
                </Button>
            </a>
        </div>
    </nav>
    <div class="container col-md-8">

        <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pending Locations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Approved Locations</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Requested User</th>
                            <th scope="col">User phone</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($non_approved_locations as $a) { ?>
                            <tr>
                                <td><?php echo $a['name'] ?></td>
                                <td><?php echo $a['description'] ?></td>
                                <td><?php echo $a['user_name'] ?></td>
                                <td><?php echo $a['user_phone'] ?></td>
                                <td>
                                    <a href="locations.php?location_id=<?php echo $a['id']; ?>"><button class="btn btn-primary">Approve</button></a>
                                </td>
                                <td>
                                    <a href="reject_location.php?id=<?php echo $a['id']; ?>"><button class="btn btn-danger">Reject</button></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (count($non_approved_locations) === 0) { ?>
                            <tr>
                                <td><?php echo "No pending locations" ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Requested User</th>
                            <th scope="col">User phone</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($approved_locations as $a) { ?>
                            <tr>
                                <td><?php echo $a['name'] ?></td>
                                <td><?php echo $a['description'] ?></td>
                                <td><?php echo $a['user_name'] ?></td>
                                <td><?php echo $a['user_phone'] ?></td>
                                <td>
                                    <a href="reject_location.php?id=<?php echo $a['id']; ?>"><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (count($approved_locations) === 0) { ?>
                            <tr>
                                <td><?php echo "No pending locations" ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
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