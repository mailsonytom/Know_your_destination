<?php include 'connect.php' ?>
<?php
$sql = "SELECT * from locations";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}
$sql = "SELECT * from categories";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$categories[] = $row;
}
$name = $email = $password = $address = $phone = $owner_name = $location = $error =  "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$flag = 0;
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$location = $_POST['location'];
	$owner_name = $_POST['owner_name'];
	$cartegory = $_POST['category'];
	$image = $_FILES['image']['name'];
	$extension = end(explode(".", $image));
	$newfilename = $code . "." . $extension;
	$target = "../images/" . $newfilename;
	echo "image ", $image;
	$select_query = "SELECT email FROM business";
	$result = mysqli_query($conn, $select_query);
	while ($row = mysqli_fetch_assoc($result)) {
		if ($row['email'] == $email) {
			$error = "Email already exist";
			$flag = 1;
			echo "error";
		}
	}
	if ($flag == 0) {
		// $sql = "INSERT INTO business (name, description, owner_name, password, email, phone, address, approved) 
        // VALUES ('$name', 'Busienss', '$owner_name', '$password', '$email', '$phone', '$address', 0)";
		// if (mysqli_query($conn, $sql)) {
		// 	echo '<script type="text/javascript">
        //             window.location = "comment.html"
        //             </script>';
		// } else {
		// 	echo "Error: " . $sql . "<br>" . $conn->error;
		// }
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
	<div class="container col-md-3">
		<form action="" method="post">
			<div align="center">
				<h2> Business sign-up</h2>
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Business name:</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Owner name:</label>
				<input type="text" name="owner_name" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Location</label>
				<select name="location" class="form-control" id="exampleFormControlSelect1">
					<?php foreach ($data as $a) { ?>
						<option value="<?php echo $a['name'] ?>"><?php echo $a['name'] ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label class="col-md-6 ">Phone</label>
				<input type="text" name="phone" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Address</label>
				<input type="text" name="address" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Email</label>
				<input type="text" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Password</label>
				<input type="text" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Repeat Password</label>
				<input type="text" name="re_password" class="form-control">
			</div>
			<div class="form-group">
				<label>Image</label><br>
				<input type="file" name="image" id="image">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Category</label>
				<select name="category" class="form-control" id="exampleFormControlSelect1">
					<?php foreach ($categories as $a) { ?>
						<option value="<?php echo $a['id'] ?>"><?php echo $a['name'] ?></option>
					<?php } ?>
				</select>
			</div>
			<br>
			<div align="center">
				<input type="Submit" value="Submit" class="btn  btn-secondary">
			</div>
			<br>
		</form>
	</div>

</body>

</html>