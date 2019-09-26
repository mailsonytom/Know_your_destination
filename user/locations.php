<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                window.location = "signin.html"
                 </script>';
} else {

    $business_user_id = $_SESSION['business_user'];
    $sql = "SELECT * from locations";

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
    <div class="container col-md-8">
        <div align="center" class="mt-3">
            <h2> Select a location</h2>
        </div>
        
        <div class="row">
            


                <?php foreach ($locations as $a) { ?>
                    <div class="col-md-4 text-dark">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2Fthumb%2F3%2F37%2FLocation_of_Rho_Cassiopeiae.png%2F1200px-Location_of_Rho_Cassiopeiae.png&f=1&nofb=1" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $a['name'] ?></h5>
                            <p class="card-text"><?php echo $a['description'] ?></p>
                            <a href="business.php?id=<?php echo $a[id] ?>" class="btn btn-primary">Explore</a>
                        </div>
                    </div>
                    </div>
                <?php } ?>
            

        </div>
    </div>

</body>

</html>