<?php
include "slider.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/header.css">
    <link rel="stylesheet" href="asset/css/slider.css">
    <link rel="stylesheet" href="asset/css/content.css">
    <link rel="stylesheet" href="asset/css/footer.css">
    <link rel="stylesheet" href="asset/css/product.css">
    <link rel="stylesheet" href="asset/css/cartegory.css">
    <link rel="stylesheet" type="" href="asset/css/cart.css">
    <link rel="stylesheet" href="./asset/font/themify-icons/themify-icons.css">
    <title>Danh mục sản phẩm</title>
</head>
<body>
<?php
include "connect.php";

$cartegory = mysqli_query($con, "SELECT cartegory_id,cartegory_name FROM `tbl_cartegory` " );
?>
<header>
<div id="menu">
                    <?php
                            while ($row = mysqli_fetch_array($cartegory)) {
                        ?>
                        
                        
                        <li><a href=""><?= $row['cartegory_name'] ?></a>
                           
                        </li>
                        
                    
                    <?php } ?>
</div>
    
        <div id="logo">
            <a href="index.html">THE WATCH</a>
        </div>

        <div id="other">
            <li><input placeholder="Tìm kiếm" type="text"> <i class="ti-search"></i> </li>
            <li> <a class="ti-user" href=""></a></li>
            <li> <a class="ti-shopping-cart" href=""></a></li>
        </div>
    </header>