<?php
class LoginController {
    public function __construct(){
        $this->loginModel = Library\Helper::model(Library\Helper::route());
    }

    public function view(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->attemptLogin($_POST);
        }
        require('./views/auth/login.php');
    }

    public function attemptLogin($post){
        if(!$this->validated($post['email'])){
            $this->oldValues($post['email']);
            return false;
        }
    }

    public function validated($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public function oldValues($email){
        $_SESSION['old']['email'] = $email;
        return true;
    }
}