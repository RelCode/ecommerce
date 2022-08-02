<?php
    class HomeController {
        public function __construct(){
            $this->homeModel = Library\Helper::model(Library\Helper::route());
        }
        public function view(){
            $data = $this->homeModel->getProducts();
            require('./views/home.php');
        }
    }
?>