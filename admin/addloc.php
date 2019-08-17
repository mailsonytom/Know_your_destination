<?php include 'connect.php' ?>
<?php
    $name = $area = $desc = $spec = $weather = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $flag = 0;
        $name = $_POST['name'];
        $area = $_POST['area'];
        $desc = $_POST['desc'];
        $spec = $_POST['spec'];
        $weather = $_POST['weather'];
        $select_query = "SELECT * FROM admin_loc";
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
        $sql = "INSERT INTO admin_loc (name, area, descr, spec, weather) VALUES ('$name', '$area', '$desc', '$spec', '$weather')";
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