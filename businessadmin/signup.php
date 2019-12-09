<?php include 'connect.php' ?>
<?php

function test_input($data, $conn)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = mysqli_real_escape_string($conn, $data);
	return $data;
}


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
	$password = $_POST['password'];
	$re_password = $_POST['re_password'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$location = $_POST['location'];
	$owner_name = $_POST['owner_name'];
	$category = $_POST['category'];
	$image = $_FILES['image']['name'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	if (
		empty($name) || empty($email) || empty($password) || empty($phone)
		|| empty($location) || empty($owner_name) || empty($category)
		|| empty($price) || empty($description)
	) {
		$error = "Please fill in all the details";
		$flag = 1;
	} else {
		$name = test_input($name, $conn);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
			$flag = 1;
			$error = "Only letters and white space allowed for business name";
		}

		$email = test_input($email, $conn);
		// check if email is valid
		if (!filter_var($email, FILTER_VALIDATE_EMAIL, $email)) {
			$flag = 1;
			$error = "Wrong email format";
		}

		$phone = test_input($phone, $conn);
		// check for valid phone number
		if (!preg_match("/^[1-9][0-9]{9}$/", $phone)) {
			$flag = 1;
			$error = "Wrong phone number format";
		}

		if ($password != $re_password) {
			$flag = 1;
			$error = "Passwords are not matching";
			echo "inside post empty", $_POST['password'], " hello ", $_POST['re_password'];
		}

		$address = test_input($address, $conn);

		$owner_name = test_input($owner_name, $conn);
		if (!preg_match("/^[a-zA-Z ]*$/", $owner_name)) {
			$flag = 1;
			$error = "Only letters and white space allowed for owner name";
		}

		$price = test_input($price, $conn);
		if (!preg_match("/^[1-9][0-9]*$/", $price)) {
			$flag = 1;
			$error = "Only digits are allowed for price";
		}

		$description = test_input($description, $conn);


		if ($flag == 0) {
			$extension = end(explode(".", $image));
			$newfilename = $name . "." . $extension;
			$target = "../images/business/" . $newfilename;
			$select_query = "SELECT email FROM business";
			$result = mysqli_query($conn, $select_query);

			while ($row = mysqli_fetch_assoc($result)) {
				if ($row['email'] == $email) {
					$error = "Email already exist";
					$flag = 1;
				} else if ($row['name'] == $name) {
					$error = "Business already exist";
					$flag = 1;
				}
			}
			if ($flag == 0) {
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				move_uploaded_file($_FILES['image']['tmp_name'], $target);
				$sql = "INSERT INTO business (name, description, owner_name, password, email, phone, address, approved, category_id, location_id, image, price) 
        VALUES ('$name', '$description', '$owner_name', '$password', '$email', '$phone', '$address', 0, $category, $location, '$target', $price)";
				if (mysqli_query($conn, $sql)) {
					echo '<script type="text/javascript">
                    window.location = "signin.php"
                    </script>';
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>BizPage Bootstrap Template</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

	<!-- Bootstrap CSS File -->
	<link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Libraries CSS Files -->
	<link href="../assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
	<link href="../assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="../assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

	<!-- Main Stylesheet File -->
	<link href="../assets/css/theme.css" rel="stylesheet">


</head>

<body style="background-image: url('../assets/img/biz-bg1.jpg'); background-size: cover;">

	<!--==========================
    Header
  ============================-->
	<header id="header" class="header-black">
		<div class="container-fluid">

			<div id="logo" class="pull-left">
				<h1><a href="#intro" class="scrollto">Know Your Destination</a></h1>
			</div>

			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li><a href="../user/">User</a></li>
					<li><a href="../admin/">Admin</a></li>
					<li><a href="./signin.php">Sign in</a></li>

				</ul>
			</nav><!-- #nav-menu-container -->
		</div>
	</header><!-- #header -->
	<div class="container col-md-6 rounded mt-5 p-4 bg-dark" style="color: #fff;">
		<form action="" method="POST" enctype="multipart/form-data" class="mt-5 mb-5">
			<div align="center">
				<h2> Business Sign Up</h2>
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
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Repeat Password</label>
				<input type="text" name="re_password" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Image</label><br>
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
			<div class="form-group">
				<label class="col-md-6 ">Price</label>
				<input type="number" name="price" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-md-6 ">Description</label>
				<textarea name="description" class="form-control" rows="5"></textarea>
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
	<!--==========================
    Footer
  ============================-->
	<footer id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">

					<div class="col-lg-3 col-md-6 footer-info">
						<h3>Know your destination</h3>
						<p>Know your destination at travel offers both the independent traveller and packaged holidaymaker a vast range of holidays and cruises to destinations Worldwide. Don't wait for your dream journey to come to you. Travel towards your dream journey.</p>
					</div>

					<div class="col-lg-3 col-md-6 footer-links">
						<h4>Useful Links</h4>
						<ul>
							<li><i class="ion-ios-arrow-right"></i> <a href="../user/">Home</a></li>
							<li><i class="ion-ios-arrow-right"></i> <a href="../admin/">Login as admin</a></li>
							<li><i class="ion-ios-arrow-right"></i> <a href="../user/signin.php">User sign in</a></li>
							<li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
							<li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
						</ul>
					</div>

					<div class="col-lg-3 col-md-6 footer-contact">
						<h4>Contact Us</h4>
						<p>
							A108 Adam Street <br>
							New York, NY 535022<br>
							United States <br>
							<strong>Phone:</strong> +1 5589 55488 55<br>
							<strong>Email:</strong> info@kyd.com<br>
						</p>
					</div>

					<div class="col-lg-3 col-md-6 footer-newsletter">
						<h4>Our Newsletter</h4>
						<p>Our newsletter is world famous for suggesting the best travel destinations available throughout the year. Subscribe to our newsletter for more !! </p>
					</div>

				</div>
			</div>
		</div>

		<div class="container">
			<div class="copyright">
				&copy; Copyright <strong>Know your destination</strong>. All Rights Reserved
			</div>
			<div class="credits">
				Designed by Team KYD
			</div>
		</div>
	</footer><!-- #footer -->

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

	<!-- JavaScript Libraries -->
	<script src="../assets/lib/jquery/jquery.min.js"></script>
	<script src="../assets/lib/jquery/jquery-migrate.min.js"></script>
	<script src="../assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/lib/easing/easing.min.js"></script>
	<script src="../assets/lib/superfish/hoverIntent.js"></script>
	<script src="../assets/lib/superfish/superfish.min.js"></script>
	<script src="../assets/lib/wow/wow.min.js"></script>
	<script src="../assets/lib/waypoints/waypoints.min.js"></script>
	<script src="../assets/lib/counterup/counterup.min.js"></script>
	<script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
	<script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
	<script src="../assets/lib/lightbox/js/lightbox.min.js"></script>
	<script src="../assets/lib/touchSwipe/jquery.touchSwipe.min.js"></script>
	<!-- Contact Form JavaScript File -->
	<script src="../assets/contactform/contactform.js"></script>

	<script src="../assets/js/main.js"></script>
</body>

</html>