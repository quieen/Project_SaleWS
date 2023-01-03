<?php  
session_start();
include "slider.php";
include "header.php";

?>
<link rel="stylesheet" href="asset/css/cart.css">

<?php
include "./connect.php";
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
            header('Location:./cart_VIDUUU.php');
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset( $_SESSION['cart'][$_GET['id']]);   
            }
            header('Location:./cart_VIDUUU.php');
            break;
        case "submit":
            if (isset($_POST['update_click']))  {//cap nhat so luong sp
                update_cart();
                header('Location:./cart_VIDUUU.php');
            }
            break;
    }    
}

if (!empty($_SESSION['cart'])){
    $product = mysqli_query($con, "SELECT * FROM `tbl_product` WHERE `product_id` IN (".implode(",",array_keys($_SESSION['cart'])).")");  
}


?>


<section class="cart">
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
            </form>
            
            
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
                        </div>
                       
                        <div class="content-right-button" >
                           <a href="pay.php"> <input style="width:140px; height:40px; background-color:red; color:white" type="submit" name="order_click" value="Đặt Hàng"></a>
                           
                        </div>
                    </div>
                </div>
            <?php  
                }
            ?>
           
            

            </div>
        </div>    
    
    </div>
</section>


<?php
include "footer.php"
?>