<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['business_user'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {
    if (isset($_GET['id'])) {
        $index = $_GET['id'];
        $sql = "UPDATE bookings set approved = 1 WHERE id=$index";
        if (mysqli_query($conn, $sql)) {
            echo '<script type="text/javascript">
                    window.location = "dashboard.php"
                    </script>';
        }
    }
    $business_user_id = $_SESSION['business_user'];
    $sql = "SELECT B.id, from_date,to_date, approved, name from bookings B INNER JOIN users U on B.user_id =  U.id WHERE B.business_id=$business_user_id  ";

    $result = mysqli_query($conn, $sql);
    while ($booking = mysqli_fetch_assoc($result)) {
        if ($booking['approved']) {
            $approved_bookings[] = $booking;
        } else {
            $non_approved_bookings[] = $booking;
        }
    }
    $sql = "SELECT name ,email, owner_name from business WHERE id=$business_user_id  ";

    $result = mysqli_query($conn, $sql);
    // $user = mysqli_fetch_assoc($result);
    while ($data = mysqli_fetch_assoc($result)) {
        $user = $data;
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
        <span class="navbar-brand mb-0 h1 text-light"><?php echo $user['name'], ' ( welcome, ', $user['owner_name'], ' )' ?></span>
        <div class="ml-auto">
            <a class="mr-2" href="request_location.php">
                <Button class="btn btn-light">
                    Request a location
                </Button>
            </a>

            <a class="" href="logout.php">
                <Button class="btn btn-outline-light">
                    Logout
                </Button>
            </a>
        </div>
    </nav>

    <div class="container col-md-8">
        <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Approved</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pending</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Name</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">

                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($approved_bookings as $a) { ?>
                            <tr>
                                <td><?php echo $a['name'] ?></td>
                                <td><?php echo $a['id'] ?></td>
                                <td><?php echo $a['to_date'] ?></td>
                                <td><?php echo $a['from_date'] ?></td>
                                <td>
                                    //
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (count($approved_bookings) === 0) { ?>
                            <tr>
                                <td><?php echo "No approved bookings" ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($non_approved_bookings as $a) { ?>
                            <tr>
                                <td><?php echo $a['name'] ?></td>
                                <td><?php echo $a['id'] ?></td>
                                <td><?php echo $a['from_date'] ?></td>
                                <td>
                                    <a href="dashboard.php?id=<?php echo $a['id']; ?>"><button>Approve</button></a>
                                </td>
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