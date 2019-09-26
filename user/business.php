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
        $sql = "SELECT * from business B WHERE B.location_id = $index";
        $result = mysqli_query($conn, $sql);
        if ($aBusiness =  mysqli_fetch_assoc($result)) {
            $businesses[] = $aBusiness;
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
    <div class="container col-md-8">
        <div align="center" class="mt-3">
            <h2> Select a business</h2>
        </div>
        <div class="row">
            <?php foreach ($businesses as $a) { ?>
                <div class="col-md-4 text-dark">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2Fthumb%2F3%2F37%2FLocation_of_Rho_Cassiopeiae.png%2F1200px-Location_of_Rho_Cassiopeiae.png&f=1&nofb=1" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $a['name'] ?></h5>
                            <p class="card-text"><?php echo $a['description'] ?></p>
                            <a href="booking.php?id=<?php echo $a[id] ?>" class="btn btn-primary">Book now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>