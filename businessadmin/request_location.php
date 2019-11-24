<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {


$name  = $description =  "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flag = 0;
    $user = $_SESSION['user_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $extension = end(explode(".", $image));
    $newfilename = $name . "." . $extension;
    $target = "../images/location/" . $newfilename;
    $select_query = "SELECT name FROM locations";
    $result = mysqli_query($conn, $select_query);
    while ($row = mysqli_fetch_assoc($result)) {
        $row_name = strtolower($row['name']);
        if ($row_name == strtolower($name)) {
            $error = "Location already exists";
            $flag = 1;
        } 
    }
    if (
        empty($name) || empty($description) || empty($image) 
    ) {
        $error = "Please fill all the details" . $name . $description . $image;
        $flag = 1;
    }
    if ($flag == 0) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "INSERT INTO locations (name, description, approved, requested_user, image) 
        VALUES ('$name', '$description', 0, $user, '$target')";
        if (mysqli_query($conn, $sql)) {
            echo '<script type="text/javascript">
                    window.location = "request_location_success.php"
                    </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <title>Request a location</title>
</head>

<body>
<nav class="navbar navbar-light bg-info">
        <span class="navbar-brand mb-0 h1 text-light">Know your destination</span>
        <div class="ml-auto">
        <a class="mr-2" href="dashboard.php">
            <Button class="btn btn-light">
                Dashboard
            </Button>
        </a>
        <a class="" href="logout.php">
            <Button class="btn btn-outline-light">
                Logout
            </Button>
        </a>
        </div>
    </nav>
    <div class="container col-md-6 rounded mt-5 p-4 bg-white">
        <form action="" method="POST" enctype="multipart/form-data">
            <div align="center">
                <h2> Request a location</h2>
            </div>
            <div class="form-group mt-5">
                <label class="col-md-6 ">Location name:</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-md-6 ">Location description:</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="form-group">
                <label>Location image</label><br>
                <input type="file" name="image" id="image">
            </div>
            <br>
            <?php
			if ($flag) { ?>
				<div align="center" class=" text-danger">
					<?php echo $error ?>
				</div>
			<?php
			}
			?>
            <div align="center">
                <input type="Submit" value="Submit" class="btn  btn-primary w-100">
            </div>
            <br>
        </form>
    </div>

</body>

</html>