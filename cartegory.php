<?php
include "header.php";
include "slider.php"
?>


<?php
        $search = isset($_GET['name']) ? $_GET['name'] : "";
        if ($search){
            $where = "WHERE `product_name` LIKE '%".$search."%'";
        }
        include "connect.php";
        $item_per_page = !empty( $_GET['per_page'])?$_GET['per_page']:4;
        $current_page = !empty( $_GET['page'])?$_GET['page']:1;
        $offset = ($current_page -1 ) * $item_per_page;
        if ($search){
            $products = mysqli_query($con, "SELECT * FROM `tbl_product` WHERE `product_name` LIKE '%".$search."%'  ORDER BY `product_id` ASC  LIMIT ".$item_per_page. " OFFSET ".$offset );
            $totalRecord = mysqli_query($con, "SELECT * FROM `tbl_product` WHERE `product_name` LIKE '%".$search."%' ");
        }else {
            $products = mysqli_query($con, "SELECT * FROM `tbl_product`  ORDER BY `product_id` ASC  LIMIT ".$item_per_page. " OFFSET ".$offset );
            $totalRecord = mysqli_query($con, "SELECT * FROM `tbl_product` ");
        }


        $totalRecord = $totalRecord -> num_rows;
        $totalPages = ceil($totalRecord / $item_per_page);
?>





<section class="cartegory">
        <div class="container">
            <div class="cartergory-top row">
                <!-- <p>Trang chủ</p> <span>&#10230; </span> <p>Nữ</p> <span>&#10230;</span> <p>Hàng nữ mới về</p>  -->
            </div>
        </div>
        <div class="container">
            <div class="row">
                

                    <div class="cartegory-right-top-item">
                        <form id="product-search" action="" method="GET">
                            <input style="height: 40px; padding:10px; border-radius:5px" type="text"  name="name"> 
                            <input style="padding: 10px; background-color:black; color:white;border-radius:5px" type="submit"  value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="cartegory-right-content row">

                        <?php
                            while ($row = mysqli_fetch_array($products)) {
                        ?>
                        <div class="cartegory-right-content-item">
                            <a href="detail.php?id= <?= $row['product_id'] ?>"><img  src="./admin/uploads/<?= $row['product_img'] ?>"  alt=""></a>
                            <h1><a href="detail.php?id= <?=$row['product_id'] ?>"><?= $row['product_name'] ?></a></h1>
                            <p><?= $row['product_price'] ?></p>
                        </div>
                        <?php } ?>
                        
                    </div>


                    <div class="cartergory-right-bottom row">
                        <div class="cartergory-right-bottom-items">
                            
                        </div>

                        <div class="cartergory-right-bottom-items">
                            <p>
                                <span>&#171;</span>
            <!-- --------------------------PHANTRANg ---------------------------------- -->
                                <?php
                                    if($current_page>3){
                                        $firstpage = 1;
                                ?>
                                    <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $firstpage ?>">First</a>
                                <?php
                                    }
                                ?>


                                <?php
                                    for ($num = 1; $num <= $totalPages; $num++){ 
                                ?>
                                    <?php if($num != $current_page ) { ?>
                                        <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
                                    <?php } else { ?>
                                        <strong ><?=$num ?></strong>
                                    <?php } ?>
                                <?php
                                    } ?>

                                
                                <?php
                                    if($current_page < $totalPages - 3){
                                        $endpage = $totalPages
                                ?>
                                    <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $endpage ?>">Last</a>
                                <?php
                                    }
                                ?>


             <!-- --------------------------PHANTRANg ---------------------------------- -->
                                <span>&#187;</span>
                            </p>
                        </div>
                        
                    </div>

                

                
            </div>
        </div>

    </section>


<?php
include "footer.php"
?>