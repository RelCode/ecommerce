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
}