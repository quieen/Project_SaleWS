<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>

<?php
$i = 0;
$product = new product;
$show_product = $product -> show_product();

?>

<div class="admin-content-right">
            <div class="admin-content-right-category_list">
                <h1>Danh sách danh mục</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Gía cả</th>
                        <td>Chỉnh sửa</td>
                    </tr>
                    <?php
                        if($show_product){
                            while($result = $show_product->fetch_assoc()){ $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['product_price'] ?></td>
                        <td><a href="product_delete.php?product_id= <?php echo $result['product_id'] ?>" >Xóa</a></td>
                        
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