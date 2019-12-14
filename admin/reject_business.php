<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
    echo '<script type="text/javascript">
                    window.location = "signin.php"
                     </script>';
} else {
    if (isset($_GET['id'])) {
        $business_id = $_GET['id'];
        $sql = "DELETE from business WHERE id='$business_id'";
        }
    }
    mysqli_query($conn, $sql);
    echo '<script type="text/javascript">
                    window.location = "business.php"
                     </script>';
?>
