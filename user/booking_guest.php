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
        $sql = "SELECT * from business B WHERE B.id = $index";
        $result = mysqli_query($conn, $sql);
        if ($aBusiness =  mysqli_fetch_assoc($result)) {
            $business = $aBusiness;
            $_SESSION["price"] = $aBusiness['price'];
        }
        $sql = "SELECT * from reviews R INNER JOIN users U on R.user_id = U.id WHERE R.business_id = $index";
        $result = mysqli_query($conn, $sql);
        while ($aReview =  mysqli_fetch_assoc($result)) {
            $reviews[] = $aReview;
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $user_id = $_SESSION['user_id'];
            $business_id = $_GET['id'];
            $checkout_price = $_POST['input_price'];

            $from_date_timestamp = strtotime($from_date);
            $to_date_timestamp = strtotime($to_date);
            $flag = 0;
            $error = "";
            if ($to_date_timestamp < $from_date_timestamp) {
                $flag = 1;
                $error = "Can't book. Check dates";
            }
            if (!$flag) {
                //     $sql = "INSERT INTO bookings (user_id, business_id, from_date, to_date, approved)
                // VALUES ('$user_id', '$business_id', '$from_date', '$to_date', 0)";
                //     if (mysqli_query($conn, $sql)) {
                //         echo '<script type="text/javascript">
                //         window.location = "mybookings.php"
                //          </script>';
                //     }
                $_SESSION['from_date'] = $from_date;
                $_SESSION['to_date'] = $to_date;
                $_SESSION['checkout_price'] = $checkout_price;
                $_SESSION['business_id'] = $business_id;
                echo '<script type="text/javascript">
                        window.location = "payment.php"
                         </script>';
            }
        }
        if (isset($_POST['check_price'])) {
            echo "price is ";
            echo $_POST['check_price'];
        }
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $user_id = $_SESSION['user_id'];
            $business_id = $_GET['id'];
            $sql = "INSERT INTO reviews (title, description, business_id, location_id, user_id)
        VALUES ('$title','$description','$business_id', 0,'$user_id')";
            if (mysqli_query($conn, $sql)) {
                echo '<script type="text/javascript">
                window.location = window.location
                 </script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <title>Know Your Destination - Business signup</title>


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
    <script type="text/javascript">

    </script>
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
                    <li class="menu-active"><a href="./index1.php">Home</a></li>
                    <li><a href="./locations_guest.php">Locations</a></li>

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
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-10">




                        <div class="row mt-6 justify-content-md-center">
                            <div align="left" class="mt-3 col-md-8">
                                <h2><?php echo $business['name'] ?> </h2>
                            </div>
                            <div class="col-md-8 mt-2 pr-3">
                                <img class="w-100 business-img-cover" src="<?php echo $business['image'] ?>" alt="Card image cap">
                                <p>
                                    <?php echo $business['description'] ?>
                                </p>
                                <hr>
                                <div class=" text-dark">
                                    <div class="card">
                                        <h5 class="card-header">Reviews</h5>
                                        <div class="card-body">
                                            <form action="" method="POST" id="review_form">
                                                <div align="left" class="font-weight-bold">
                                                    Login to write review.
                                                </div>
                                                
                                            </form>
                                            <hr>
                                            <?php foreach ($reviews as $a) { ?>
                                                <h5 class="card-title"><?php echo $a['title'] ?></h5>
                                                <p class="card-text"><?php echo $a['description'] ?></p>
                                                <div> (<?php echo $a['name'] ?>)</div>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <form method="POST" id="checkout_form" name="checkout">

                    <input type="submit" id="submit" />
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style type="text/css">
        .datepicker {
            font-size: 0.875em;
        }

        .datepicker .table-condensed {
            color: black;
        }

        /* solution 2: the original datepicker use 20px so replace with the following:*/

        .datepicker td,
        .datepicker th {
            width: 1.5em;
            height: 1.5em;
        }
    </style>
    <script type="text/javascript">
        $('#from_datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
            startDate: '+1d'
        });
        $('#to_datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker').datepicker("setDate", new Date());

        $('#from_datepicker').focusout(function() {
            setTimeout(calculatePrice, 1000)
        })
        $('#to_datepicker').focusout(function() {
            setTimeout(calculatePrice, 1000)
        })
        var date_diff_indays = function(date1, date2) {
            dt1 = new Date(date1);
            dt2 = new Date(date2);
            return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
        }
        var calculatePrice = function() {
            var fromDate = $('#from_datepicker').val()
            var toDate = $('#to_datepicker').val();
            var difference = date_diff_indays(new Date(fromDate), new Date(toDate));
            if (difference && difference > 0) {
                var price = <?php echo $_SESSION['price'] ?>;
                var content = "<h1>hello</h1>"
                $('#price-title').text('Checkout Price');
                var checkoutPrice = difference * price;
                $('#price-div').text(difference + " x " + price + " = " + checkoutPrice);
                document.getElementById("checkout_price").value = checkoutPrice;
                // document.getElementById('checkout_form').submit();
                document.checkout.submit();
            }
        }
    </script>

</body>


</html>