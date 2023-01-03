<?php
include "./admin/database.php";
?>

<?php

class pay {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

    public function insert_pay($pay_name,$pay_phone,$pay_address,$pay_addressTinh,$pay_addressHuyen,$pay_note) {
       
        $query = "INSERT INTO `order` (`name_user`, `phone`,`address_tinh`,`address_huyen`,`address_diachi`,`note`) 
                  VALUES ('$pay_name','$pay_phone','$pay_address','$pay_addressTinh','$pay_addressHuyen','$pay_note')";
        
        
        $result = $this -> db -> insert($query);
        
        return $result;
    }












    public function show_cartegory(){
        $query = "SELECT * FROM tbl_cartegory    ORDER BY cartegory_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function get_cartegory($cartegory_id){
        $query = "SELECT * FROM tbl_cartegory  WHERE cartegory_id = '$cartegory_id' ";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function update_cartegory($cartgory_name,$cartegory_id) {
        $query = "UPDATE tbl_cartegory SET cartegory_name = '$cartgory_name' WHERE cartegory_id= '$cartegory_id' ";
        $result = $this -> db -> update($query);
        header('Location:cartegory_list.php');
        return $result;
    }

    public function delete_cartegory($cartegory_id){
        $query = "DELETE FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id' " ;
        $result = $this -> db -> delete($query);
        header('Location:cartegory_list.php');
        return $result;
    }
}

?>