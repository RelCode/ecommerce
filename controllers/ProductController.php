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
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->addToCart($_POST);
        }
        // var_dump($data);
        require('./views/product.php');
    }

    public function addToCart($post){
        $this->oldValues($post);
        //confirm token to prevent CSRF
        if(empty($post['csrf-token']) || $post['csrf-token'] != $_SESSION['csrf']['token']){
            $this->alert('danger','invalid request. try again');
            return false;
        }
        //check if provided SKU matches the ID URL
        if($post['product'] != Library\Helper::attributeId()){
            $this->alert('danger','invalid product ID');
            return false;
        }
        $product = $this->productModel->allWhereIdSingle('products','sku',$post['product']);
        //if product does not exist, display alert
        if(empty($product)){
            $this->alert('danger','product no longer available');
            return false;
        }
        //check if quantity is available to place an order
        if($product['quantity'] < 1){
            $this->alert('danger','out of stock');
            return false;
        }
        //check if user is loggedIn, if not use temp ID to create a cart
        if(isset($_SESSION['customer'])){
            $id = $_SESSION['customer']['id'];
        }else{
            $id = $_COOKIE['visitor'];
        }
        //add content to cart
        $store = $this->productModel->storeToCart($id,$post);
        if($store == '500'){
            $this->alert('danger','server error. try again');
            return false;
        }
        $this->productModel->updateQty($product['sku'],$product['quantity'] - 1);
        $this->alert('success','1 item added to cart');
        return true;
    }

    public function alert($class,$message){
        $_SESSION['alert']['class'] = $class;
        $_SESSION['alert']['message'] = $message;
        return true;
    }

    public function oldValues($post){
        $_SESSION['old']['size'] = $post['size'];
        $_SESSION['old']['colour'] = $post['colour'];
        return true;
    }
}