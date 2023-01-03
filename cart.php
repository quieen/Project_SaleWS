<?php  
session_start();
include "slider.php";
include "header.php";


?>
<link rel="stylesheet" href="asset/css/cart.css">

<?php
include "./connect.php";
$error = false;
$sucess=  false;
if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}


if (isset($_GET['action'])){
    function update_cart($add = false){
        foreach ($_POST['quantity'] as $id => $quantity){
            if($add){
                $_SESSION['cart'][$id] += $quantity;
            }else{
                $_SESSION['cart'][$id] = $quantity;
            }
                
        }
    }

    switch ($_GET['action']){
        case "add" :
            update_cart(true);
            header('Location:./cart.php');
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset( $_SESSION['cart'][$_GET['id']]);   
            }
            header('Location:./cart.php');
            break;
        case "submit":
            if (isset($_POST['update_click']))  {//cap nhat so luong sp
                update_cart();
                header('Location:./cart.php');
            }elseif ($_POST['order_click']){
                if(empty($_POST['name_user'])){
                    $error = "Bạn chưa nhập tên";
                }elseif (empty($_POST['phone'])){
                    $error = "Bạn chưa nhập số điện thoại";
                }elseif (empty($_POST['address_tinh'])){
                    $error = "Bạn chưa nhập tỉnh thàng";
                }elseif (empty($_POST['address_huyen'])){
                    $error = "Bạn chưa nhập huyện"; 
                }elseif (empty($_POST['address_diachi'])){
                    $error = "Bạn chưa nhập địa chỉ";
                }

                if ($error==false && !empty($_POST['quantity'])){

                    $product = mysqli_query($con,"SELECT * FROM `tbl_product` WHERE `product_id` IN (".implode(",", array_keys($_POST['quantity'])).")");
                    $total =0;
                    $orderProduct = array();
                    while ($row = mysqli_fetch_array($product)) {
                        $orderProduct[] = $row; 
                        $total += $row['product_price'] * $_POST['quantity'][$row['product_id']];
                    }
                    $insertOrder = mysqli_query($con,"INSERT INTO `order` (`id`, `name_user`, `phone`, `address_tinh`, `address_huyen`, `address_diachi`, `note`, `total`) VALUES (NULL, '".$_POST['name_user']."', '".$_POST['phone']."', '".$_POST['address_tinh']."', '".$_POST['address_huyen']."', '".$_POST['address_diachi']."', '".$_POST['note']."', '".$total."');");
                    $insertString = "";
                    $orderID = $con->insert_id;
                   
                    foreach($orderProduct as $key => $product) {
                        $insertString .=  "(NULL, '".$orderID."', '".$product['product_id']."', '".$product['product_name']."', '".$_POST['quantity'][$product['product_id']]."', '".$product['product_price']."')";
                        if($key != count($orderProduct) - 1){
                            $insertString .=",";
                        }
                    }
                    // $insertString = "(NULL, '".$orderID."', '111', '213', '1231', '02'),". "(NULL, '".$orderID."', '4', '135', '1235', '3156'),"." (NULL, '".$orderID."', '19', '2', '2', '100000')";
                    //('1', '1', '111', '1', '21', '1'), ('2', '2', '2', '2', '2', '')
                    $insertOrder = mysqli_query($con,"INSERT INTO `oder_detail` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `product_price`) VALUES ".$insertString.";");
                    $sucess = "Đặt Hàng thành công";
                    unset($_SESSION['cart']);
                    
                }
                
            }
            break;
    }    
}

if (!empty($_SESSION['cart'])){
    $product = mysqli_query($con, "SELECT * FROM `tbl_product` WHERE `product_id` IN (".implode(",",array_keys($_SESSION['cart'])).")");  
}
?>



<section class="cart">
    <?php 
        if (!empty($sucess)){
    ?>
            <div style="padding: 20px; color:red; font-size:30px; font-weight: 400;">
                <span><sup>*</sup><?= $sucess ?></span>
            </div>
    <?php
        }
    ?>

    <div class="container">
        <div class="cart-content row">
            <form class="row" id="cart-form" action="cart.php?action=submit" method="POST">
                    <div class="cart-content-left">
                        <table>
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Tổng Tiền</th>
                                <th></th>
                            </tr>
                            <?php
                                if(!empty($product)){
                                    $total_product = 0;
                                    $total = 0;
                                    while ($row = mysqli_fetch_array($product)) {
                                        ?>
                                        
                                        <tr>
                                            <td><img src="./admin/uploads/<?= $row['product_img'] ?>" alt=""></td>
                                            <td><p><?=$row['product_name'] ?></p></td>
                                            <td><input type="number" value="<?=$_SESSION['cart'][$row['product_id']]?>" min="1" name="quantity[<?=$row['product_id'] ?>]"></td>
                                            <td><p><sup>£</sup><?=$row['product_price'] * $_SESSION['cart'][$row['product_id']]?></p></td>
                                            <td><a style="color: black; text-decoration:none;" href="cart.php?action=delete&id=<?=$row['product_id'] ?>"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        <?php
                                        $total +=   $row['product_price'] * $_SESSION['cart'][$row['product_id']];
                                        $total_product += $_SESSION['cart'][$row['product_id']];
                                    }
                                
                            ?>
                            
                        </table>
                        
                        <div class="cart-content-left-button">
                            <button><a style=" color:white; text-decoration:none; font-size:10px;" href="cartegory.php">Tiếp tục mua hàng</a></button>
                            <input style="width:140px; height:40px; margin-left: 500px; background-color:brown;color:white" type="submit" name="update_click" value="Cập Nhật">
                        </div>
                    </div>
                
            
            
                    <div style="padding-left: 100px;" class="cart-content-right">
                        <div class="cart-content-right-not">
                            <table>

                                <tr>
                                    <th colspan="2">Tổng tiền giỏ hàng</th>
                                </tr>
                            
                                <tr>
                                    <td>Tổng sản phẩm</td>
                                    <td><?=$total_product ?></td>
                                </tr>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <td><p><sup>£</sup><?=$total ?></p></td>
                                </tr>
                                
                                <tr>
                                    <td>Tạm tính</td>
                                    <td><p style="color: black; font-weight: bold;"><sup>£</sup><?=$total ?></p></td>
                                </tr>

                            </table>
    
                        <div class="cart-content-right-text">
                            <div class="content-right-notice row">
                                <i style="color: red;" class="ti-info-alt"></i> 
                                <p style="color:red;">Miễn đổi trả đối với sản phẩm đồng giá / sale trên 50%</p>
                            </div>
        
                            <div class="content-right-notice row">
                                <i style="color: red;" class="ti-info-alt"></i> 
                                <p style="color:red;">Miễn phí ship đơn hàng có tổng gía trị trên 2.000.000đ</p>
                            </div>
        
                            <div class="content-right-notice row ">
                                <i style="color: red;" class="ti-info-alt"></i> 
                            <p style="color: red;">Mua thêm 110.000đ để được miễn phí SHIP</p>
                            </div><br>


                            <p style="font-size:20px; font-weight:300;">Địa Chỉ giao hàng</p>
                            <div style="color: red;" id="notify-msg">
                                <?= (!empty($error)) ? $error: "" ?>
                            </div>
                            
                            <div style="padding: 12px 0;" class="delivery-content-left-input-top-item">
                                <input style="width:100%; height:35px; border-radius:10px;padding:12px;"
                                  name="name_user" type="text" placeholder="Họ tên">
                            </div>

                            <div style="padding: 12px 0;" class="delivery-content-left-input-top-item">
                                <input style="width:100%; height:35px; border-radius:10px;padding:12px;"  name="phone" type="text" placeholder="Số điện thoại">
                            </div>

                            <div style="padding: 12px 0;" class="delivery-content-left-input-top-item">
                                <input style="width:100%; height:35px; border-radius:10px;padding:12px;"  name="address_tinh" type="text" placeholder="Tỉnh/Thành phố">
                            </div>

                            <div style="padding: 12px 0;" class="delivery-content-left-input-top-item">
                                <input style="width:100%; height:35px; border-radius:10px;padding:12px;"  name="address_huyen"  type="text" placeholder="Quận/Huyện">
                            </div>

                            <div style="padding: 12px 0;" class="delivery-content-left-input-bottom">
                                <input style="width:100%; height:35px; border-radius:10px;padding:12px;"  name="address_diachi" type="text" placeholder="Địa chỉ">
                                <br><br>
                                <input style="width:100%; height:35px; border-radius:10px;padding:12px;"  name="note" type="text" placeholder="Ghi chú">
                            </div>
                            <div class="content-right-button" >
                            <input style="width:140px; height:40px; background-color:red; color:white; border-radius:30px 0" type="submit" name="order_click" value="Đặt Hàng">
                            <!-- <button style="width:140px; height:40px; background-color:red; color:white" type="submit" name="order_click"><a href="pay.php">Đặt Hàng</a></button> -->
                            </div>
                        </div>
                    </div>
                    <?php  
                        }
                    ?>
            </form> 
        </div>  
    </div>
</section>


