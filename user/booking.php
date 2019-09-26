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
            <h2><?php echo $business[name] ?> </h2>
        </div>
        <div class="row mt-4">
            <div class="col-md-8 mt-2 pr-3">
                <img class="w-100" src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2Fthumb%2F3%2F37%2FLocation_of_Rho_Cassiopeiae.png%2F1200px-Location_of_Rho_Cassiopeiae.png&f=1&nofb=1" alt="Card image cap">
                <p>
                    <?php echo $business[description] ?>
                </p>
            </div>
            <div class="col-md-4 mt-5">
                <form action="" method="POST">
                    <div align="left">
                        <h2>Book now</h2>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 ">From date:</label>
                        <input type="text" name="username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 ">To date:</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div align="left">
                        <input type="Submit" value="Submit" class="btn  btn-secondary">
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>