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
	$category = $_POST['category'];
	$image = $_FILES['image']['name'];
	$extension = end(explode(".", $image));
	$newfilename = $name . "." . $extension;
	$target = "../images/business/" . $newfilename;
	echo "image ", $image;
	$select_query = "SELECT email FROM business";
	$result = mysqli_query($conn, $select_query);
	while ($row = mysqli_fetch_assoc($result)) {
		if ($row['email'] == $email) {
			$error = "Email already exist";
			$flag = 1;
			echo "error";
		} else if ($row['name'] == $name) {
			$error = "Business already exist";
			$flag = 1;
		}
	}
	if (
		empty($name) || empty($email) || empty($password) || empty($phone)
		|| empty($location) || empty($owner_name) || empty($category)
	) {
		$error = "Please fill in all the details";
		$flag = 1;
	}
	if ($flag == 0) {
		echo "location id", $location;
		move_uploaded_file($_FILES['image']['tmp_name'], $target);
		$sql = "INSERT INTO business (name, description, owner_name, password, email, phone, address, approved, category_id, location_id, image) 
        VALUES ('$name', 'Busienss', '$owner_name', '$password', '$email', '$phone', '$address', 0, $category, $location, '$target')";
		if (mysqli_query($conn, $sql)) {
			echo '<script type="text/javascript">
                    window.location = "signin.php"
                    </script>';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
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
	<nav class="navbar navbar-light bg-info">
		<span class="navbar-brand mb-0 h1 text-light">Know your destination</span>
		<div class="ml-auto">
		<a class="mr-2" href="../admin/">
                <Button class="btn btn-light">
                    Sign in as Admin
                </Button>
			</a>
			<a class="mr-2" href="../user/">
                <Button class="btn btn-light">
                    Sign in as User
                </Button>
            </a>
			<a class="" href="signin.php">
				<Button class="btn btn-outline-light">
					Sign In
				</Button>
			</a>
		</div>
	</nav>
	<div class="container col-md-6 rounded mt-5 p-4 bg-white">
		<form action="" method="POST" enctype="multipart/form-data">
			<div align="center">
				<h2> Business sign-up</h2>
			</div>
			<div class="form-group mt-5">
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
						<option value="<?php echo $a['id'] ?>"><?php echo $a['name'] ?></option>
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
				<input type="Submit" value="Submit" class="btn  btn-primary w-100">
			</div>
			<br>
		</form>
	</div>

</body>

</html>