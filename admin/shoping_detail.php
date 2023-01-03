<?php
include "header.php";
include "slider.php";
include "class/shoping_detail.php";

?>

<?php
$i = 0;
$shoping_detail = new shoping_detail;
$show_shopingdetail = $shoping_detail -> show_shopingdetail();
?>


<div class="admin-content-right">
            <div class="admin-content-right-category_list">
                <h1>Danh sách danh mục</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Gía cả / sản phẩm</th>             
                    </tr>
                    <?php
                        if($show_shopingdetail){
                            while($result = $show_shopingdetail->fetch_assoc()){ $i++;                       
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['order_id'] ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['quantity'] ?></td>
                        <td><?php echo $result['product_price'] ?></td>
                        <td></td>
                    </tr>
                    <?php
                               
                            }
                        }
                    ?>

                   
                </table>
            </div>
        </div>
    </section>
</body>
</html>