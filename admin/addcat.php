<?php include 'connect.php' ?>
<?php
    $cat = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $flag = 0;
        $cat = $_POST['catname'];
        $select_query = "SELECT * FROM admin_cat";
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
        $sql = "INSERT INTO admin_cat (category) VALUES ('$cat')";
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