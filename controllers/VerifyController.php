<?php
class VerifyController {
    public function __construct(){
        $this->verifyModel = Library\Helper::model(Library\Helper::route());
        $this->email = isset($_GET['email']) ? $_GET['email'] : '';
        $this->code = isset($_GET['code']) ? $_GET['code'] : '';
    }

    public function view(){
        if(empty($this->email) || empty($this->code)){
            $this->alert('danger','invalid link');
        }else{
            $user = $this->verifyModel->getUser($this->email, $this->code);
            if (empty($user)) {
                $this->alert('danger', 'unknown link');
            }elseif ($user['verified'] == 'Y') {
                $this->alert('warning', 'account already verified. <a href="/ecommerce/login" class="text-decoration-none">login</a>');
            }else{
                $verify = $this->verifyModel->verifyUser($this->email,$this->code);
                if($verify == '500'){
                    $this->alert('danger','verification failed. try again');
                }else{
                    $this->alert('success', 'account verified. proceed to <a href="/ecommerce/login" class="text-decoration-none">login</a>');
                }
            }
        }
        require_once('./views/auth/verify.php');
    }

    public function alert($class,$message){
        $_SESSION['alert']['class'] = $class;
        $_SESSION['alert']['message'] = $message;
        return true;
    }
}