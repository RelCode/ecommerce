<?php
class ProductController {
    public function __construct(){
        $this->productModel = Library\Helper::model(Library\Helper::route());
    }

    public function view(){
        $data = $this->productModel->fetchProduct(Library\Helper::attributeId());
        if(!empty($data)){
            $data['images'] = $this->productModel->allWhereIdRows('product_images','product',$data['id']);
        }
        // var_dump($data);
        require('./views/product.php');
    }
}