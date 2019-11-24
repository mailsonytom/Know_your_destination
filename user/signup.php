<?php include 'connect.php' ?>
<?php
$name = $username = $password = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flag = 0;
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $select_query = "SELECT * FROM users";
    $result = mysqli_query($conn, $select_query);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['username'] == $username) {
            $flag = 1;
            $error = "User already exists";
        }
    }
    if ($flag == 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, username, password, phone, email, address) VALUES ('$name', '$username', '$password', '$phone', '$email', '$address')";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">
                    window.location = "signin.php"
                    </script>';
        } else {
            $flag = 1;
            $error = "Unable to sign up";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <title>User signup</title>
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
            <a class="" href="signin.php">
                <Button class="btn btn-outline-light">
                    Sign In
                </Button>
            </a>
        </div>
    </nav>
    <div class="container col-md-6 rounded bg-white mt-5 p-4">
        <form action="" method="POST">
            <div align="center">
                <h2>User Signup</h2>
            </div>
            <div class="form-group">
                <label class="col-md-6 ">Name:</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-md-6 ">Email:</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-md-6 ">Phone:</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-md-6 ">Address:</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-md-6 ">Username:</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="form-group">
                <label class="col-md-6 ">Password:</label>
                <input type="Password" name="password" class="form-control">
            </div>
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
        </form>
    </div>

</body>

</html>