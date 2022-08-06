<?php
class CheckoutController {
    public function __construct(){
        $this->checkoutModel = Library\Helper::model(Library\Helper::route());
    }
    public function view(){
        if (isset($_SESSION['customer']) && $_SESSION['customer']['hasProfile'] == 'Y') {
            $profile = $this->checkoutModel->getUserProfile($_SESSION['customer']['id']);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->processTransaction($_POST);
        }
        require('./views/checkout.php');
    }

    public function processTransaction($post){
        $this->oldValues($post);
        //ensure anti-csrf is enforced
        if ($post['csrf-token'] != $_SESSION['csrf']['token']) {
            $this->swal('danger','error', 'invalid request');
            return false;
        }
        $valid = true;
        //validate country name
        if($post['country'] != 'south africa'){
            $_SESSION['validation']['country'] = 'invalid country';
            $valid = false;
        }
        // validate province
        if (empty($this->checkoutModel->allWhereIdSingle('provinces', 'id', $post['province']))) {
            $_SESSION['validation']['province'] = 'invalid province selection';
            $valid = false;
        }
        // validate city
        if (empty($this->checkoutModel->allWhereIdSingleEqual('cities', 'id', $post['city'], 'province', $post['province']))) {
            $_SESSION['validation']['city'] = 'invalid city selected';
            $valid = false;
        }
        //validate zip code
        if (!preg_match("/^\\d+$/", $post['zip'])) {
            $_SESSION['validation']['zip'] = 'invalid zip';
            $valid = false;
        }
        //validate phone number
        if (!preg_match("/^\\d+$/", $post['phone'])) {
            $_SESSION['validation']['phone'] = 'invalid phone number';
            $valid = false;
        }
        //validate branch code == 6digits
        if (!preg_match("/^\\d+$/", $post['branch'])) {
            $_SESSION['validation']['branch'] = 'invalid branch code';
            $valid = false;
        }
        //validate card number == digits only
        if (!preg_match("/^\\d+$/", $post['card'])) {
            $_SESSION['validation']['card'] = 'invalid card number';
            $valid = false;
        }
        //validate card expiry date and format == M/Y
        if (!preg_match("/^\\d+$/", $post['expiry_date'])) {
            $_SESSION['validation']['expiry_date'] = 'invalid date';
            $valid = false;
        }
        //validate CVV == digits and length == 3
        if (!preg_match("/^\\d+$/", $post['cvv']) || strlen($post['cvv']) != 3) {
            $_SESSION['validation']['cvv'] = 'invalid cvv';
            $valid = false;
        }
        if($valid == false){
            return false;
        }
        var_dump($post);
    }

    public function swal($icon,$title,$text){
        $_SESSION['swal']['icon'] = $icon;
        $_SESSION['swal']['title'] = $title;
        $_SESSION['swal']['text'] = $text;
        return true;
    }

    public function oldValues($post){
        $_SESSION['old']['address'] = $post['address'];
        $_SESSION['old']['zip'] = $post['zip'];
        $_SESSION['old']['phone'] = $post['phone'];
        $_SESSION['old']['card'] = $post['card'];
        $_SESSION['old']['expiry_date'] = $post['expiry_date'];
        $_SESSION['old']['cvv'] = $post['cvv'];
    }
}