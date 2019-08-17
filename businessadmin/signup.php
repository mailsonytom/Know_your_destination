<?php include 'connect.php' ?>
<?php
    $bsname = $owname = $address = $phone = $username = $password = $option = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $flag = 0;
        $bsname = $_POST['buname'];
        $owname = $_POST['onname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $username = $_POST['email'];
        $password = $_POST['password'];
        $option = $_POST['opt'];
        $select_query = "SELECT * FROM bsignup";
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
        $sql = "INSERT INTO bsignup (bname, oname, address, phone, email, password, options) VALUES ('$bsname', '$owame', '$address', '$phone', '$username', '$password',  '$option')";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">
                    window.location = "signin.php"
                    </script>';
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
}

?>