<?php
include "database.php";
?>

<?php

class shoping_detail {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

   

    public function show_shopingdetail(){
        $query = "SELECT * FROM `oder_detail`";
        $result = $this -> db -> select($query);
        return $result;
    }
     

}

?>