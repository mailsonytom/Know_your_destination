<?php include 'connect.php' ?>
<?php
session_start();
if(isset($_SESSION['admin_user'])) {
	include 'logout.php';
}
$username = $password = $error_text ="";
$error_flag = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM admin WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
	if ($row = mysqli_fetch_assoc($result)) {
		echo "sfgs", $row['username'];
		if (password_verify($password, $row['password'])) {
			$_SESSION['admin_user'] = $row['id'];
			 echo '<script type="text/javascript">
                window.location = "dashboard.php"
                 </script>';
		} else {
			$error_flag = 1;
			$error_text = "Wrong password.";
		}
	} else {
		$error_flag = 1;
		$error_text = "Wrong username.";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<title> Admin signin</title>
</head>
<body>
	<div class="container col-md-3">
		<form action="" method="POST">
			<div align="center">
				<h2>Admin Signin </h2>
			</div>
		<div class="form-group">
			<label class="col-md-3 ">Username:</label>
				<input type="text" name="username" class="form-control">
		</div>
		
		
		<div class="form-group">
			<label class="col-md-3 ">Password:</label>
			<input type="password" name="password" class="form-control">
		</div>
		<?php
		if ($error_flag) { ?>
				<div align="center" class=" text-danger">
					<?php echo $error_text ?>
				</div>
			<?php
			}
			?>
		<div align="center">	
		   <input type="Submit" value="submit" class="btn  btn-secondary">
	    </div>
	    </form>
	</div>
	
</body>
</html>