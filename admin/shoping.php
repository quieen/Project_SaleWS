<?php
include "header.php";
include "slider.php";
include "class/shoping_class.php";

?>

<?php
$i = 0;
$shoping = new shoping;
$show_shoping = $shoping -> show_shoping();
?>


<div class="admin-content-right">
            <div class="admin-content-right-category_list">
                <h1>Danh sách danh mục</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Tỉnh</th>
                        <th>Huyện</th>
                        <th>Địa chỉ</th>
                        <th>Lưu ý</th>
                        <th>Tổng tiền</th>
                        
                    </tr>
                    <?php
                        if($show_shoping){
                            while($result = $show_shoping->fetch_assoc()){ $i++;                       
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['id'] ?></td>
                        <td><?php echo $result['name_user'] ?></td>
                        <td><?php echo $result['phone'] ?></td>
                        <td><?php echo $result['address_tinh'] ?></td>
                        <td><?php echo $result['address_huyen'] ?></td>
                        <td><?php echo $result['address_diachi'] ?></td>
                        <td><?php echo $result['note'] ?></td>
                        <td><?php echo $result['total'] ?></td>
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