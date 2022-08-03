<?php
require_once('./config/database.php');
class Verify extends Database {
    public function getUser($email,$code){
        $row = '';
        $query = 'SELECT * FROM users WHERE email = :email AND verification_code = :code LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':code',$code);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $row;
    }

    public function verifyUser($email,$code){
        $query = 'UPDATE users SET verified = "Y" WHERE email = :email AND verification_code = :code';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':code',$code);
        if($stmt->execute()){
            return '200';
        }
        return '500';
    }
}