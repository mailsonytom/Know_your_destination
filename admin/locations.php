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
        <span class="navbar-brand mb-0 h1 text-light">Admin Dashboard</span>
        <a class="ml-auto" href="logout.php">
            <Button class="btn btn-outline-light">
                Logout
            </Button>
        </a>
    </nav>
    <nav class="navbar navbar-light bg-light">
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
                                    <a href="dashboard.php?location_id=<?php echo $a['id']; ?>"><button class="btn btn-primary">Approve</button></a>
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
        <div>


            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>