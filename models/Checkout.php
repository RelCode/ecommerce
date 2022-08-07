<?php
require_once('./config/database.php');
class Checkout extends Database {
    public function getUserProfile($id){
        $query = 'SELECT p.user, p.street_address, p.zip_code, p.city, p.province, p.phone_number, s.name as state, c.name as area 
            FROM profile as p 
            INNER JOIN provinces as s ON p.province = s.id 
            INNER JOIN cities as c ON p.city = c.id 
            WHERE p.user = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        return '';
    }

    public function getCartContents($cart){
        $query = 'SELECT cc.colour, cc.size, p.name, p.price 
            FROM cart_contents as cc 
            INNER JOIN products as p 
            ON cc.product = p.sku 
            WHERE cc.cart = :cart';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cart',$cart);
        if($stmt->execute()){
            $data = [];
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($data,$row);
                }
            }
            return $data;
        }
        return false;
    }

    public function completeTransaction($customer,$cart,$post){
        $query = 'INSERT INTO checkout (customer, cart, street_address, zip_code, city, province, phone_number, branch_code, card_number, card_expiry, cvv) VALUES (:customer,:cart,:address,:zip,:city,:province,:phone,:branch,:card,:expiry,:cvv)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':customer',$customer);
        $stmt->bindParam(':cart',$cart);
        $stmt->bindParam(':address',$post['address']);
        $stmt->bindParam(':zip', $post['zip']);
        $stmt->bindParam(':city', $post['city']);
        $stmt->bindParam(':province', $post['province']);
        $stmt->bindParam(':phone', $post['phone']);
        $stmt->bindParam(':branch', $post['branch']);
        $stmt->bindParam(':card', $post['card']);
        $stmt->bindParam(':expiry', $post['expiry_date']);
        $stmt->bindParam(':cvv', $post['cvv']);
        if($stmt->execute()){
            $lastId = $this->db->lastInsertId();
            if($this->updateCartStatus($cart,$customer)){
                return true;
            };
            $this->transactionRollback($lastId,$customer,$cart);
        }
        return false;
    }
    public function updateCartStatus($cart,$customer){
        $query = 'UPDATE cart SET status = "fulfilled" WHERE id = :cart AND created_by = :customer';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cart',$cart);
        $stmt->bindParam(':customer',$customer);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function transactionRollback($id,$customer,$cart){
        $query = 'DELETE FROM checkout WHERE id = :id AND  customer = :customer AND cart = :cart';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':customer',$customer);
        $stmt->bindParam(':cart',$cart);
        $stmt->execute();
        return true;
    }
}