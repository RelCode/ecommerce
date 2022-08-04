<?php
class ProfileController {
    public function __construct(){
        $this->profileModel = Library\Helper::model(Library\Helper::route());
    }

    public function view(){
        require('./views/profile.php');
    }
}