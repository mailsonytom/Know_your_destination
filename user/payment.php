<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "signin.php"
                     </script>';
} else {
    $from_date =  $_SESSION['from_date'];
    $to_date =  $_SESSION['to_date'];
    $price = $_SESSION['checkout_price'];
    $business_id = $_SESSION['business_id'];
    $user_id = $_SESSION['user_id']; 
    $cardno = $expiry = $cvv = $error = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST["cardno"])) {
            $error = "Card number is required";
            $flag = 1;
        } else {
            $cardno = $_POST["cardno"];
            if (!preg_match("/^[1-9][0-9]{15}$/", $cardno)) {
                $flag = 1;
                $error = "Wrong card number";
            }
        }
        if (empty($_POST["expiry"])) {
            $error = "Expiry date is required";
            $flag = 1;
        } else {
            $exp = $_POST["expiry"];
            if (!preg_match("/^[1][0-9]\/[0-9]{2}$/", $exp)) {
                $flag = 1;
                $error = "Wrong expiry date";
            }
        }
        if (empty($_POST["expiry"])) {
            $error = "Expiry date is required";
            $flag = 1;
        } else {
            $cvv = $_POST["cvv"];
            if (!preg_match("/^[0-9]{3}$/", $cvv)) {
                $flag = 1;
                $error = "Wrong cvv";
            }
        }
        if ($flag == 0) {
                $sql = "INSERT INTO bookings (user_id, business_id, from_date, to_date, approved)
                VALUES ('$user_id', '$business_id', '$from_date', '$to_date', 0)";
                echo $sql;
                    if (mysqli_query($conn, $sql)) {
                        echo '<script type="text/javascript">
                        window.location = "mybookings.php"
                         </script>';
                    }
        }
    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />
        <title>Checkout</title>


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
        <style type="text/css">
            html,
            body,
            header,
            .carousel {
                height: 60vh;
            }
        </style>
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
                        <li><a href="./locations.php">Locations</a></li>

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
                        <div class="col-md-12 mt-5 rounded bg-white">


                            <div class="col-md-12 text-center mt-4">
                                <h3 class="font-weight-bold">Complete your payment</h3>
                            </div>
                            <hr />
                            <div class="row my-5">
                                <div class="col-md-6">
                                    <!-- <div style="height: 200px; width: 75%"> -->

                                    <img src="../assets/img/payment.jpg" alt="payment" class="w-100 h-100" />
                                    <!-- </div> -->

                                </div>
                                <div class="col-md-4 ml-5">
                                    <div>

                                        From Date: <span class="font-weight-bold"><?php echo $from_date ?></span>
                                    </div>
                                    <div class="mt-2">
                                        
                                        To Date: <span class="font-weight-bold"><?php echo $to_date ?></span>
                                    </div>
                                    <div class="mt-2">
                                        
                                        Total: &#x20B9;<span class="font-weight-bold h3 text-dark"><?php echo $price ?></span>
                                    </div>
                                    <hr />
                                    <form action="" method="POST">
                                        <label>Enter card number</label>
                                        <input type="text" name="cardno" class="form-control" placeholder="Enter card nubmer" />
                                        <label>Enter expiry date</label>
                                        <input type="text" name="expiry" class="form-control" placeholder="MM/YY">
                                        <label>Enter CVV</label>
                                        <input type="password" name="cvv" class="form-control" placeholder="CVV">
                                        <input type="submit" value="Submit" class="btn btn-secondary mt-3">
                                        <br>
                                        <span class="error"><?php echo $error; ?></span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </section>
        </main>
        <!--/.Footer-->

        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="../assets/js/jquery-3.4.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../assets/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
        <!-- Initializations -->
        <script type="text/javascript">
            // Animations initialization
            new WOW().init();
        </script>
    </body>
<?php } ?>

    </html>