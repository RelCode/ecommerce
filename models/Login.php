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
    //we taking an older cart created by the now logged in user and adding the new content just added
    public function addNewCartContentsToOlderCart($newCart,$oldCart){
        $query = 'UPDATE cart_contents SET cart = :old WHERE cart = :new';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':old',$oldCart);
        $stmt->bindParam(':new',$newCart);
        if($stmt->execute()){
            $this->deleteNewCart($newCart);
            return true;
        }
        return false;
    }
    //we are changing cart owner from visitor's link in the cookies to signed in user's ID
    public function switchCartFromVisitorToCustomer($cart,$customer){
        $query = 'UPDATE cart SET created_by = :customer WHERE id = :cart';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':customer',$customer);
        $stmt->bindParam(':cart',$cart);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //after moving new content to older cart, delete the cart that was used by visitor
    public function deleteNewCart($id){
        $query = 'DELETE FROM cart WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return true;
    }
}