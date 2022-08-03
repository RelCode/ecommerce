<?php
require_once('./config/database.php');
class Login extends Database {
    public function updateVerificationCode($email,$code){
        $query = 'UPDATE users SET verification_code = :code WHERE email = :email';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':code',$code);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        return true;
    }
}