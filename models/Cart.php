<?php
require_once('./config/database.php');
class Cart extends Database {
    public function getAllFromCart($customer){
        $data = [];
        $query = 'SELECT c.id, c.status, cc.product, cc.colour, cc.size, p.sku, p.name, p.unit, p.price, p.thumbnail, cat.cat_name, b.brand_name 
            FROM cart as c 
            INNER JOIN cart_contents as cc ON c.id = cc.cart 
            INNER JOIN products as p ON cc.product = p.sku 
            INNER JOIN categories as cat ON p.category = cat.id 
            INNER JOIN brands as b ON p.brand = b.id 
            WHERE c.created_by = :customer AND c.status = "waiting"';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':customer',$customer);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($data,$row);
                }
            }
        }else{
            $data[0] = '500';
        }
        return $data;
    }

    public function removeItem($cart,$product){
        $query = 'DELETE FROM cart_contents WHERE cart = :cart AND product = :product LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cart',$cart);
        $stmt->bindParam(':product',$product);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function replenishQty($product){
        $query = 'UPDATE products SET quantity = quantity + 1 WHERE sku = :product';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product',$product);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}