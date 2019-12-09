<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['business_user'])) {
    echo '<script type="text/javascript">
                    window.location = "signin.php"
                     </script>';
} else {
    if (isset($_GET['id'])) {
        $booking_id = $_GET['id'];
        $sql = "UPDATE bookings SET approved = 2 WHERE id='$booking_id'";
        }
    }
    mysqli_query($conn, $sql);
    echo '<script type="text/javascript">
                    window.location = "dashboard.php"
                     </script>';
?>
