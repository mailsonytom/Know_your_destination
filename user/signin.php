<?php include 'connect.php' ?>
<?php

session_start();
$username = $password = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            echo '<script type="text/javascript">
                window.location = "locations.php"
                 </script>';
                 echo "Success";
        } else {
            echo "Wrong password. <a href='signin.html'>Click here to try again.</a>";
        }
    } else {
        echo "Wrong username. <a href='signin.html'>Click here to try again.</a>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<title>signin</title>
</head>
<body>
<nav class="navbar navbar-light bg-info">
        <span class="navbar-brand mb-0 h1 text-light">Know your destination</span>
        <div class="ml-auto">
        <a class="" href="signup.php">
            <Button class="btn btn-outline-light">
                Sign Up
            </Button>
        </a>
        </div>
    </nav>
	<div class="container col-md-6 rounded mt-5 p-4 bg-white">
		<form action="" method="POST">
			<div align="center">
				<h2>User Signin</h2>
			</div>
		<div class="form-group">
			<label class="col-md-6 ">Username:</label>
				<input type="text" name="username" class="form-control">
		</div>
		
		<div class="form-group">
			<label class="col-md-6 ">Password:</label>
			<input type="password" name="password" class="form-control">
		</div>
		<div align="center">	
		   <input type="Submit" value="Submit" class="btn  btn-primary w-100">
	    </div>
	    </form>
	</div>
	
</body>
</html>