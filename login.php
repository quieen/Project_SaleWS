<?php
include './connect.php';
session_start();



if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($con,"SELECT * FROM `tbl_user` WHERE username ='$username' AND password= '$password' ");
    $nick = mysqli_query($con,"SELECT * FROM `tbl_user` WHERE `level` ");

    if(mysqli_num_rows($result) == 1){
        header('location:./admin/productadd.php');
    }else{
        echo "tai khoan mat khau sai";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LOGIN</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="" href="./asset/css/login.css">
    </head>
    <body >
        <section class="login">
        <div class="titulo">Staff Login</div>
        <form action="login.php" method="post" enctype="application/x-www-form-urlencoded">
            <input type="text" name="username"  title="Username required" placeholder="Username" data-icon="U">
            <input type="password" name="password"  title="Password required" placeholder="Password" data-icon="x">
            <div class="olvido">
                <div class="col"><a href="resgiter.php" title="Ver Carásteres">Register</a></div>
            </div>
            <input class="enviar" type="submit" name="login" value="LOGIN">
        </form>
        </section>

    </body>
    <script src="./function/login.js">
        
    </script>
</html>