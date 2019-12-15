<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "signin.php"
                     </script>';
} else {
    if (isset($_GET['id'])) {
        $booking_id = $_GET['id'];
        $sql = "DELETE FROM bookings WHERE id='$booking_id'";
        }
    }
    mysqli_query($conn, $sql);
    echo '<script type="text/javascript">
                    window.location = "mybookings.php"
                     </script>';
?>
