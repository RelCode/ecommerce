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

    public function storeToCart($id,$post){
        //check if user has an existing cart
        $cart = $this->allWhereIdSingleEqual('cart','created_by',$id,'status','waiting');
        if(!empty($cart)){
            $cart_id = $cart['id'];//if a cart owned by this shopper is found, get cart ID
        }else{
            $query = 'INSERT INTO cart (created_by) VALUES (:customer)';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':customer',$id);
            if(!$stmt->execute()){
                return '500';
            }
            $cart_id = $this->db->lastInsertId();//get id of the last created cart
        }
        $query = 'INSERT INTO cart_contents (cart, product, colour, size) VALUES (:cart, :product, :colour, :size)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cart',$cart_id);
        $stmt->bindParam(':product',$post['product']);
        $stmt->bindParam(':colour',$post['colour']);
        $stmt->bindParam(':size',$post['size']);
        if(!$stmt->execute()){
            return '500';
        }
        return '200';
    }
}