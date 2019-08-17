<?php include 'connect.php' ?>
<?php

    session_start();
    $username = $password = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM bsignup WHERE email = '$username'";
        $result = mysqli_query($conn, $sql);
        if($row=mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                echo '<script type="text/javascript">
                window.location = ""
                 </script>';
            }
            else{
                    echo "Wrong password. <a href='signin.html'>Click here to try again.</a>";  
            }
        }
        else{
                echo "Wrong username. <a href='signin.html'>Click here to try again.</a>";
            }
        }
?>