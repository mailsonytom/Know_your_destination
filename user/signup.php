<?php include 'connect.php' ?>
<?php
    $name = $username = $password = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $flag = 0;
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $select_query = "SELECT * FROM users";
        // echo $username, $password, $name;
    $result = mysqli_query($conn, $select_query);
    while($row=mysqli_fetch_assoc($result)){
        if($row['username'] == $username){
        $flag = 1;
            echo '<script type="text/javascript">
                    window.location = "user_duplicate_error.php"
                    </script>';
        }
    }
    if($flag == 0){
        $password =password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, username, password, phone, email, address) VALUES ('$name', '$username', '$password', '$phone', '$email', '$address')";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">
                    window.location = "signin.html"
                    </script>';
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
}

?>