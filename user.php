<?php

function checkuser($user_name, $pass){
    $host = "localhost";
    $user = "root";
    $password = "";
    $database= "website";
    $conn = mysqli_connect($host, $user, $password, $database);
    $stmt = $conn ->prepare("SELECT * FROM tbl_user WHERE user ='$user_name' AND pass ='$pass'");
    $stmt ->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
}

?>