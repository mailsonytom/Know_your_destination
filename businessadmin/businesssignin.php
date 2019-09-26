<?php include 'connect.php' ?>
<?php
session_start();
if(isset($_SESSION['business_user'])) {
	include 'logout.php';
}
$username = $password = $error_text ="";
$error_flag = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM business WHERE email = '$username'";
	$result = mysqli_query($conn, $sql);
	if ($row = mysqli_fetch_assoc($result)) {
		if(!$row['approved']) {
			$error_flag = 1;
			$error_text = "Busness not approved. Contact Admin.";
		}
		else if (password_verify($password, $row['password'])) {
			$_SESSION['business_user'] = $row['id'];
			echo "success" , $_SESSION['business_user'];
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

	<title>signin</title>
</head>

<body>
	<div class="container col-md-3">
		<form action="" method="POST">
			<div align="center">
				<h2> Business Sign-in</h2>
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Username:</label>
				<input type="text" name="username" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">password:</label>
				<input type="text" name="password" class="form-control">
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
				<input type="Submit" value="Submit" class="btn  btn-secondary">
			</div>
		</form>

	</div>

</body>

</html>