<?php include 'connect.php' ?>
<?php
    $name = $username = $password = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $flag = 0;
        $option = $_POST['ops'];
        $from = $_POST['fd'];
        $to = $_POST['td'];
        $select_query = "SELECT * FROM user_booking";
    $result = mysqli_query($conn, $select_query);
    while($row=mysqli_fetch_assoc($result)){
        if($row['userid'] == $username){
        $flag = 1;
            echo '<script type="text/javascript">
                    window.location = "user_duplicate_error.php"
                    </script>';
        }
    }
    if($flag == 0){
        $sql = "INSERT INTO user_booking (options, fromdate, todate) VALUES ('$option', '$from', '$to')";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">
                    window.location = ""
                    </script>';
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
}

?>