<?php
class RegisterController {
    public function __construct(){
        $this->registerModel = Library\Helper::model(Library\Helper::route());
    }

    public function view(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->createAccount($_POST);
        }
        require('./views/auth/register.php');
    }

    public function createAccount($post){
        if(!$this->validated($post)){
            $this->oldValues($post);
            return false;
        }
        if($post['password'] != $post['confirm']){
            $_SESSION['validation']['password'] = 'chosen password & repeated password must match';
            $this->oldValues($post);
            return false;
        }
        $user = $this->registerModel->allWhereIdSingle('users','email',$post['email']);
        if(!empty($user)){
            $_SESSION['validation']['email'] = 'email address is already registered';
            $this->oldValues($post);
            return false;
        }
        $verification = bin2hex(random_bytes(64));
        $storeUser = $this->registerModel->store($post,$verification);
        if($storeUser == '500'){
            $this->alert('danger','user  registration failed. try again');
            $this->oldValues($post);
            return false;
        }
        $this->sendEmail($post,$verification);
        $this->alert('success','user registered successfully. check your email inbox');
        return true;
    }

    public function validated($post){
        $valid = true;
        if (!preg_match("/^[a-zA-Z-' ]*$/", $post['names'])) {
            $_SESSION['validation']['names'] = 'name contains invalid character';
            $valid = false;
        }
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['validation']['email'] = 'Invalid email address';
            $valid = false;
        }
        return $valid;
    }

    public function alert($class,$message){
        $_SESSION['alert']['class'] = $class;
        $_SESSION['alert']['message'] = $message;
        return true;
    }

    public function sendEmail($post,$code){
        $to = $post['email'];
        $subject = 'PH-ECommerce Account Verification';

        $message = '
            <html>
            <head>
            <title>Congratulations!</title>
            </head>
            <body>
            <h4>Hi '.$post['names'].'! You Have Successfully Created Your PH-ECommerce Account</h4>
            <h6>Please Click The Button Below To Verify Your Email Address</h6>
            <a href="/ecommerce/verify/?email='.$post['email'].'&code='.$code. '" style="padding:15px;background-color:#007bff;border-color:#007bff">Verify</a>
            <br/>

            </body>
            </html>';

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= "From: <noreply@ph-ecommerce.com>" . "\r\n";

        mail($to, $subject, $message, $headers);
        return true;
    }

    public function oldValues($post){
        $_SESSION['old']['names'] = $post['names'];
        $_SESSION['old']['email'] = $post['email'];
        return true;
    }
}