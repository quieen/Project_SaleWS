<?php
include "./admin/class/cart_class.php";
include "header.php";
include "slider.php";

?>

<?php
$pay = new pay;
if ($_SERVER['REQUEST_METHOD']=== 'POST'){
    $pay_name = $_POST['name_user'];
    $pay_phone = $_POST['phone'];
    $pay_address = $_POST['address_diachi'];
    $pay_addressTinh = $_POST['address_tinh'];
    $pay_addressHuyen = $_POST['address_huyen'];
    $pay_note = $_POST['note'];
    $insert_pay = $pay -> insert_pay($pay_name,$pay_phone,$pay_address,$pay_addressTinh,$pay_addressHuyen,$pay_note);
}
?>

    
<section class="delivery">
    <div class="delivery-content row">
        <div class="delivery-content-left">
            <p>Địa chỉ giao hàng</p>
            <div class="delivery-content-left-dangnhap">
                <button>Đăng nhập</button>
                <button >Đăng ký</button>
                <p>Đăng nhập/ Đăng ký tài khoản để được tích điểm và nhận thêm nhiều ưu đãi từ IVY moda.</p>
            </div>
            <div class="delivery-content-left-diachi row">
                <i class="ti-check"></i>
                <p>Địa Chỉ</p>
            </div>

            <form action="" method="POST">
                <div class="delivery-content-left-input-top row">
                    <div class="delivery-content-left-input-top-item">
                        <input required name="name_user" type="text" placeholder="Họ tên">
                    </div>

                    <div class="delivery-content-left-input-top-item">
                        <input required name="phone" type="text" placeholder="Số điện thoại">
                    </div>

                    <div class="delivery-content-left-input-top-item">
                        <input required name="address_tinh" type="text" placeholder="Tỉnh/Thành phố">
                    </div>

                    <div class="delivery-content-left-input-top-item">
                        <input required name="address_huyen"  type="text" placeholder="Quận/Huyện">
                    </div>
                </div>

                <div class="delivery-content-left-input-bottom">
                    <input required name="address_diachi" type="text" placeholder="Địa chỉ">
                    <br>
                    <input required name="note" type="text" placeholder="Ghi chú">
                </div>
            
            
            
            <div class="payment-content-left-method-delivery">
                    <p style="font-weight: bold;">Phương thức giao hàng</p>

                    <div class="payment-content-left-method-delivery-item">
                        <input checked type="radio">
                        <label for="">Giao hàng chuyển phát nhanh</label>
                    </div>
                </div>

                <div class="payment-content-left-method-payment">
                    <p style="font-weight: bold;">Phương thức thanh toán</p>
                    
                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment"  type="radio">
                        <label for="">Thanh toán bằng thẻ tín dụng</label>
                    </div>

                    <div class="payment-content-left-method-payment-item-img">
                        <img src="./asset/img/pay.png" alt="">
                    </div>

                    <div class="payment-content-left-method-payment-item">
                        <input checked name="method-payment"  type="radio">
                        <label for="">Thanh toán bằng thẻ ATM </label>
                    </div>

                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment"  type="radio">
                        <label for="">Thanh toán bằng Momo</label>
                    </div>

                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment" type="radio">
                        <label for="">Thanh toán khi giao hàng</label>
                    </div>
                </div>
                <div class="delivery-content-left-button row">
                <a href="pay.php"> <span class="ti-arrow-left"></span> Giỏ Hàng</a>
                <button style="font-weight: bold;" type="submit">Thanh Toán và Giao Hàng</button>
            </div>

        </form>
        </div>

    </div>
</section>
    



<?php
include "./footer.php"
?>
