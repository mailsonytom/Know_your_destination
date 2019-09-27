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
            $sql = "INSERT INTO bookings (user_id, business_id, from_date, to_date, approved)
        VALUES ('$user_id', '$business_id', '$from_date', '$to_date', 0)";
            if (mysqli_query($conn, $sql)) {
                echo "success";
            }
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
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <title>Business signup</title>
</head>

<body>
    <div class="container col-md-8">
        <div align="center" class="mt-3">
            <h2><?php echo $business[name] ?> </h2>
        </div>
        <div class="row mt-4">
            <div class="col-md-8 mt-2 pr-3">
                <img class="w-100" src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2Fthumb%2F3%2F37%2FLocation_of_Rho_Cassiopeiae.png%2F1200px-Location_of_Rho_Cassiopeiae.png&f=1&nofb=1" alt="Card image cap">
                <p>
                    <?php echo $business[description] ?>
                </p>
                <hr>
                <div class=" text-dark">
                    <div class="card">
                        <h5 class="card-header">Reviews</h5>
                        <div class="card-body">
                            <form action="" method="POST" id="review_form">
                                <div align="left">
                                    Write a review
                                </div>
                                <div class="form-group">
                                    <!-- <label class="col-md-6 ">title:</label> -->
                                    <input type="text" name="title" class="form-control" placeholder="Title">

                                </div>

                                <div class="form-group">
                                    <!-- <label class="col-md-6 ">description:</label> -->
                                    <textarea name="description" class="form-control" form="review_form" placeholder="Description"> </textarea>

                                </div>
                                <div align="left">
                                    <input type="Submit" value="Submit" class="btn  btn-secondary">
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
            <div class="col-md-4 mt-5">
                <form action="" method="POST">
                    <div align="left">
                        <h2>Book now</h2>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 ">From date:</label>
                        <input data-date-format="dd/mm/yyyy" id="from_datepicker" name="from_date">

                    </div>

                    <div class="form-group">
                        <label class="col-md-6 ">To date:</label>
                        <input data-date-format="dd/mm/yyyy" id="to_datepicker" name="to_date">

                    </div>
                    <div align="left">
                        <input type="Submit" value="Submit" class="btn  btn-secondary">
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style type="text/css">
        // solution 1:
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
        });
        $('#to_datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker').datepicker("setDate", new Date());
    </script>
</body>


</html>