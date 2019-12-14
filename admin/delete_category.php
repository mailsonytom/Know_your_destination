<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
    echo '<script type="text/javascript">
                    window.location = "signin.php"
                     </script>';
} else {
    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];
        $sql = "DELETE from categories WHERE id='$category_id'";
    }
}
mysqli_query($conn, $sql);
echo '<script type="text/javascript">
                    window.location = "category.php"
                     </script>';
?>
