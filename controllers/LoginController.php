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
        $this->oldValues($post['email']);
        if(!$this->validated($post['email'])){
            return false;
        }
        $user = $this->loginModel->allWhereIdSingle('users','email',$post['email']);
        if(empty($user)){
            $this->alert('danger','provided email not registered');
            return false;
        }
        if($user['verified'] == 'N'){
            $verification = bin2hex(random_bytes(64));//generate a new verification code
            $this->loginModel->updateVerificationCode($post['email'],$verification);
            $this->sendEmail($post['email'],$verification);
            $this->alert('danger','account is not verified. check your email');
            return false;
        }
        if(!password_verify($post['password'],$user['password'])){
            $this->alert('danger','incorrect login details');
            return false;
        }
        $_SESSION['customer']['id'] = $user['id'];
        $_SESSION['customer']['names'] = $user['names'];
        $_SESSION['customer']['email'] = $user['email'];
        $_SESSION['customer']['hasProfile'] = $user['hasProfile'];
        $_SESSION['customer']['loggedIn'] = true;
        header('location:/ecommerce/');
    }

    public function validated($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['validation']['email'] = 'invalid email address';
            return false;
        }
        return true;
    }

    public function alert($class,$message){
        $_SESSION['alert']['class'] = $class;
        $_SESSION['alert']['message'] = $message;
    }

    public function oldValues($email){
        $_SESSION['old']['email'] = $email;
        return true;
    }

    public function sendEmail($email,$code){
        $to = $email;
        $subject = 'PH-ECommerce Account Verification';

        $message = '
            <html>
            <head>
            <title>Congratulations!</title>
            </head>
            <body>
            <h4>Verify Your PH-ECommerce Account</h4>
            <h5>Please Click The Button Below To Verify Your Email Address</h5>
            <a href="/ecommerce/verify/?email='.$email.'&code='.$code. '" style="padding:15px;background-color:#007bff;border-color:#007bff">Verify</a>
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
}