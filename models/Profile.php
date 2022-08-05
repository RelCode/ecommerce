<?php
require_once('./config/database.php');
class Profile extends Database {
    public function createProfile($post){
        //update user has profile status first
        if($this->updateUser($_SESSION['customer']['id'])){
            $query = 'REPLACE INTO profile (user, phone_number, street_address, zip_code, city, province, country) VALUES (:user, :phone, :address, :zip, :city, :province, :country)';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user', $_SESSION['customer']['id']);
            $stmt->bindParam(':phone', $post['phone']);
            $stmt->bindParam(':address', $post['address']);
            $stmt->bindParam(':zip', $post['zip']);
            $stmt->bindParam(':city', $post['city']);
            $stmt->bindParam(':province', $post['province']);
            $stmt->bindParam(':country', $post['country']);
            if($stmt->execute()){
                return '200';
            }
        }
        return '500';
    }

    public function updateUser($id){
        $query = 'UPDATE users SET hasProfile = "Y" WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id',$id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

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