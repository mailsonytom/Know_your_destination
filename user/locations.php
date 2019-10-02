<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {

    $business_user_id = $_SESSION['business_user'];
    $sql = "SELECT * from locations WHERE approved = 1";

    $result = mysqli_query($conn, $sql);
    while ($aLocation = mysqli_fetch_assoc($result)) {
        $locations[] = $aLocation;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <title>Business signup</title>
</head>

<body>
    <nav class="navbar navbar-light bg-info">
        <span class="navbar-brand mb-0 h1 text-light">Know your destination</span>
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
        <div align="center" class="mt-5">
            <h2> Select a location</h2>
        </div>

        <div class="row mt-4">



            <?php foreach ($locations as $a) { ?>
                <div class="col-md-4 text-dark">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top kyd-img-card " src="<?php echo $a['image'] ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $a['name'] ?></h5>
                            <p class="card-text"><?php echo $a['description'] ?></p>
                            <a href="business.php?id=<?php echo $a[id] ?>" class="btn btn-primary">Explore</a>
                        </div>
                    </div>
                </div>
            <?php } ?>


        </div>
        <?php 
                if(count($locations) == 0) {
                    echo "
                        <div align='center' class='text-secondary'>
                        <h3 >No approved locations in this location</h3>
                        </div>
                        ";
                }
            ?>
    </div>

</body>

</html>