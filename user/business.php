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
        <span class="navbar-brand mb-0 h1 text-light">Know your destination</span>
        <div class="ml-auto">
        <a class="mr-2" href="../businessadmin/businesssignup.php">
            <Button class="btn btn-light">
                Add your business
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
            <h2> Select a business</h2>
        </div>
        <div class="row mt-4">
            <?php foreach ($businesses as $a) { ?>
                <div class="col-md-4 text-dark">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top kyd-img-card " src="<?php echo $a['image'] ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $a['name'] ?></h5>
                            <p class="card-text"><?php echo $a['description'] ?></p>
                            <a href="booking.php?id=<?php echo $a[id] ?>" class="btn btn-primary">Book now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        </div>
        <?php 
                if(count($businesses) == 0) {
                    echo "
                        <div align='center' class='text-secondary'>
                        <h3 >No approved business in this location</h3>
                        </div>
                        ";
                }
            ?>
    </div>
</body>

</html>