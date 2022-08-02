<?php
class RegisterController {
    public function __construct(){
        $this->registerModel = Library\Helper::model(Library\Helper::route());
    }

    public function view(){
        require('./views/auth/register.php');
    }
}