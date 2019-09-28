<?php include 'connect.php' ?>
<?php
$category_name = $error_msg = "";
session_start();
session_start();
if (!isset($_SESSION['admin_user'])) {
    include 'logout.php';
} else {
    $sql = "SELECT * from categories";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $flag = 0;
        $category_name = $_POST['category_name'];
        $select_query = "SELECT * FROM categories";
        $result = mysqli_query($conn, $select_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $name = strtolower($row['name']);
            if ($name == strtolower($category_name)) {
                $flag = 1;
                $error_msg = "Category already exists.";
            }
        }
        if ($flag == 0) {
            $sql = "INSERT INTO categories (name) VALUES ('$category_name')";
            if (mysqli_query($conn, $sql)) {
                echo '<script type="text/javascript">
                    window.location = "category.php"
                    </script>';
            } else {
                $flag = 1;
                $error_msg = "Unable to add.";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Add category</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-light bg-info">
        <span class="navbar-brand mb-0 h1 text-light">Admin Dashboard</span>
        <a class="ml-auto" href="logout.php">
            <Button class="btn btn-outline-light">
                Logout
            </Button>
        </a>
    </nav>
    <nav class="navbar navbar-light bg-light">
        <div class="m-auto ">

        <a href="business.php">
                <Button class="btn btn-light">
                    Business
                </Button>
            </a>
            <a href="locations.php">
                <Button class="btn btn-light">
                    Location
                </Button>
            </a>
            <a href="category.php">
                <Button class="btn btn-secondary">
                    Category
                </Button>
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-md-center mt-5 ">
            <div class="col-md-6 bg-white mr-2 rounded pb-3">
                <div align="left" class="mt-3">
                    <h2> Categories</h2>
                </div>
                <div class="mt-3">
                    <?php foreach ($categories as $a) { ?>
                        <span class="badge badge-warning p-3 m-2"><?php echo $a['name'] ?></span>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4 border-left border-dark">
                <form action="" method="post">
                    <div align="left">
                        <h2> Add New</h2>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Category Name:</label>
                        <input type="text" name="category_name" class="form-control">
                    </div>
                    <?php
                    if ($flag) { ?>
                        <div align="center" class=" text-danger">
                            <?php echo $error_msg ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div align="left">
                        <input type="Submit" value="Submit" class="btn  btn-secondary">
                    </div>
                </form>
            </div>

        </div>

    </div>
</body>

</html>