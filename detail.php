<?php
include 'header.php';
include 'slider.php'
?>


<?php
include "connect.php";
$detail = mysqli_query($con, "SELECT * FROM `tbl_product` WHERE `product_id` = ".$_GET['id'] );
$product = mysqli_fetch_assoc($detail);

$img_desc = mysqli_query($con, "SELECT * FROM `tbl_product_img_desc` WHERE `product_id` = ".$_GET['id'] );
$product['images'] = mysqli_fetch_all($img_desc, MYSQLI_ASSOC);

?>

<section class="product">
    <div class="container">
        <div class="product-top row">
            <!-- <p>Trang chủ</p> <span>&#10230; </span> <p>Nữ</p> <span>&#10230;</span> <p>Hàng nữ mới về</p> <span>&#10230;</span> <p>SET ÁO DÀI HOÀNG KIM</p> -->
        </div>

        <div class="product-content row">
            <div class="product-content-left row">
                <div class="product-content-left-big-img">
                    <img  src="./admin/uploads/<?= $product['product_img'] ?>" alt="">
                </div>

            <?php if(!empty($product['images'])) { ?>

                <div class="product-content-left-small-img">
                    <?php foreach($product['images'] as $img){?>
                        <img src="./admin/uploads/<?= $img['product_img_desc'] ?>" alt="">
                    <?php } ?>
                </div>
            <?php } ?>
            </div>

            <div class="product-content-right">
                <div class="product-content-right-product-name">
                    <h1><?= $product['product_name'] ?></h1>
                    <p></p>
                </div>

                <div class="product-content-right-product-price">
                    <p><?= $product['product_price'] ?></p>
                </div>

                
                <div class="product-content-right-product-button">
                    <p style="font-weight: bold;">Số lượng : </p>
                    <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                            <input  type="number" min="1" value="1"  name="quantity[<?=$product['product_id']?>]"size= "2" /><br>
                            <button type=""><input type="submit" name="" value="Mua Hàng"></button>
                    </form>      
                </div>
                
                

                <div class="product-content-right-product-icon">
                    <div class="product-content-right-product-icon-item">
                        <i class="fas ti-mobile"> <p>Hotline</p></i> 
                    </div>
                    <div class="product-content-right-product-icon-item">
                        <i class="fas ti-comment"> <p>Chat</p></i> 
                    </div>
                    <div class="product-content-right-product-icon-item">
                        <i class="fas ti-email"> <p>Mail</p></i> 
                    </div>
                </div>

                <div class="product-content-right-bottom">
                    <div class="product-content-right-bottom-top">
                        <i class="ti-angle-down"></i>
                    </div>

                    <div class="product-content-right-bottom-content-big">
                        <div class="product-content-right-bottom-content-title row">
                            <div class="product-content-right-bottom-content-title-item gioithieu">
                                <p>Giới thiệu</p>
                            </div>

                            
                        </div>

                        <div class="product-content-right-bottom-content">
                            
                            
                            <div class="product-content-right-bottom-content-gioithieu">
                                <p><?= $product['product_desc'] ?></p>
                            </div>
                        
                        

                            
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
</section>



<?php
include  "footer.php";
?>
<script src="./function/product.js"></script>