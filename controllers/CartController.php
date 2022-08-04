<?php
class CartController {
    public function __construct(){
        $this->cartModel = Library\Helper::model(Library\Helper::route());
        $this->shopperId = isset($_SESSION['customer']) ? $_SESSION['customer']['id'] : $_COOKIE['visitor'];
    }

    public function view(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->removeFromCart($_POST);
        }
        $data = $this->cartModel->getAllFromCart($this->shopperId);
        // var_dump($data);
        require('./views/cart.php');
    }

    public function removeFromCart($post){
        //verify anti-csrf
        if(empty($post['csrf-token']) || $post['csrf-token'] != $_SESSION['csrf']['token']){
            $this->alert('danger','invalid action');
            return false;
        }
        //check if cart belongs to current shopper
        $cart = $this->cartModel->allWhereIdSingleEqual('cart','id',$post['cart'],'created_by',$this->shopperId);
        if(empty($cart)){
            $this->alert('danger','invalid request');
            return false;
        }
        //remove item from cart
        if(!$this->cartModel->removeItem($post['cart'],$post['product'])){
            $this->alert('warning','server error. try again');
            return false;
        }
        //add 1 to current product qty
        if(!$this->cartModel->replenishQty($post['product'])){
            $this->alert('warning','server error. try again');
            return false;
        }
        $this->alert('success','item removed from cart');
        return true;
    }

    public function alert($class,$message){
        $_SESSION['alert']['class'] = $class;
        $_SESSION['alert']['message'] = $message;
        return true;
    }
}