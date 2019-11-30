<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {
    if (isset($_GET['id'])) {
        $index = $_GET['id'];
        $sql = "SELECT * from business B WHERE B.location_id = $index AND B.approved = 1";
        $result = mysqli_query($conn, $sql);
        while ($aBusiness =  mysqli_fetch_assoc($result)) {
            $businesses[] = $aBusiness;
        }
    }
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT B.id, B.from_date,B.to_date, B.approved, U.name from bookings B INNER JOIN business U on B.business_id =  U.id WHERE B.user_id=$user_id";

    $result = mysqli_query($conn, $sql);
    while ($booking = mysqli_fetch_assoc($result)) {
        $bookings[] = $booking;
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
                    <li class=""><a href="#intro">Home</a></li>
                    <li><a href="locations1.php">Locations</a></li>
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

            <div class="container col-md-8 mt-5">
                <header class="section-header">
                    <h3>My Bookings</h3>
                </header>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">Approved</th>
                                    <th scope="col">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($bookings as $a) { ?>
                                    <tr>
                                        <td><?php echo $a['name'] ?></td>
                                        <td><?php echo $a['from_date'] ?></td>
                                        <td><?php echo $a['to_date'] ?></td>
                                        <td><?php
                                                if ($a['approved']) {
                                                    echo "Yes";
                                                } else {
                                                    echo "No";
                                                }
                                            }
                                            ?></td>

                                    </tr>
                                    <?php  ?>
                                    <?php if (count($bookings) === 0) { ?>
                                        <tr>
                                            <td><?php echo "No bookings" ?></td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
                <div>
                </div>
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
                            <input type="email" name="email"><input type="submit" value="Subscribe">
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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>