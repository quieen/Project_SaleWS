<?php
include "database.php";
?>

<?php

class shoping {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

    public function insert_cartegory($cartgory_name) {
        $query = "INSERT INTO tbl_cartegory (cartegory_name) VALUES ('$cartgory_name')";
        $result = $this -> db -> insert($query);
        header('Location:cartegory_list.php');
        // return $result;
    }

    public function show_shoping(){
        $query = "SELECT * FROM `order` ";
        $result = $this -> db -> select($query);
        return $result;
    }

}

?>