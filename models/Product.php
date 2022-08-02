<?php
require_once('./config/database.php');
class Product extends Database {
    public function fetchProduct($id){
        $data = [];
        $id = htmlentities($id,ENT_QUOTES);
        $query = 'SELECT p.id, p.sku, p.name, p.description, p.colour, p.size, p.available_colours, p.available_sizes, p.target, p.unit, p.price, p.quantity, p.thumbnail, b.brand_name, c.cat_name 
            FROM products as p 
            INNER JOIN brands as b 
            ON p.brand = b.id 
            INNER JOIN categories as c 
            ON p.category = c.id 
            WHERE p.sku = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id',$id);
        if(!$stmt->execute()){
            $data = ['500'];
        }
        if($stmt->rowCount() > 0){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            $data = ['The Product is No Longer Available'];
        }
        return $data;
    }
}