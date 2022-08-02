<?php
class ProductController {
    public function __construct(){
        $this->productModel = Library\Helper::model(Library\Helper::route());
    }

    public function view(){
        $data = $this->productModel->fetchProduct(Library\Helper::attributeId());
        var_dump($data);
        require('./views/product.php');
    }
}