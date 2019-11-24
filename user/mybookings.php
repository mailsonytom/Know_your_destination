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
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <title>Business signup</title>
</head>

<body>
<nav class="navbar navbar-light bg-info">
        <span class="navbar-brand mb-0 h1 text-light">My Bookings</span>
        <div class="ml-auto">

        
        <a class="mr-2" href="./locations.php">
            <Button class="btn btn-light">
                Locations
            </Button>
        </a>
        <a  href="logout.php">
            <Button class="btn btn-outline-light">
                Logout
            </Button>
        </a>
        </div>
    </nav>
    
    <div class="container col-md-8 mt-5">

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
                                    if($a['approved']){
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


            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>