<?php
require_once('./config/database.php');
class Register extends Database {
    public function store($post,$code){
        $id = uniqid();
        $pass = password_hash($post['password'],PASSWORD_DEFAULT);
        $query = 'INSERT INTO users (id, names, email, password, verification_code) VALUES (:id, :names, :email, :password,:code)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':names',$post['names']);
        $stmt->bindParam(':email',$post['email']);
        $stmt->bindParam(':password',$pass);
        $stmt->bindParam(':code',$code);
        if($stmt->execute()){
            return '200';
        }
        return '500';
    }
}