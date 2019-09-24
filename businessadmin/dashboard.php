<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['business_user'])) {
    echo '<script type="text/javascript">
                window.location = "businesssignin.php"
                 </script>';
} else {
    $business_user_id = $_SESSION['business_user'];
    $sql = "SELECT * from bookings WHERE business_id=$business_user_id  ";
    
    $result = mysqli_query($conn, $sql);
    while ($booking = mysqli_fetch_assoc($result)) {
        if ($booking['approved']) {
           $approved_bookings[] = $booking;
        } else {
            $non_approved_bookings[] = $booking;
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <title>Business signup</title>
</head>

<body>
    <div class="container col-md-6">
        <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Approved</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pending</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php foreach($approved_bookings as $a){?>  
			<div><?php echo $a['from_date'], $a['id']?></div>
			<?php }?>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Pending list
            <?php foreach($non_approved_bookings as $a){?>  
			<div><?php echo $a['from_date']?></div>
			<?php }?>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
        <div>


            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>