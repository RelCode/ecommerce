<?php
class CheckoutController {
    public function __construct(){
        $this->checkoutModel = Library\Helper::model(Library\Helper::route());
        $this->customer = isset($_SESSION['customer']) ? $_SESSION['customer']['id'] : $_COOKIE['visitor'];
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
            $this->swal('error','error', 'invalid request');
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
        //validate branch code == 6 digits only
        if (!preg_match("/^\\d+$/", $post['branch']) || strlen($post['branch']) != 6) {
            $_SESSION['validation']['branch'] = 'invalid branch code';
            $valid = false;
        }
        //validate card number == digits only & string length is not less than 8 or more than 16
        if (!preg_match("/^\\d+$/", $post['card']) || strlen($post['card']) < 8 || strlen($post['card']) > 16) {
            $_SESSION['validation']['card'] = 'invalid card number';
            $valid = false;
        }
        //validate card expiry date and format == M/Y
        $dates = explode('/',$post['expiry_date']);
        if ($dates[0] < 1 || $dates[0] > 12) {//check if month is between 1&12 months
            $_SESSION['validation']['expiry_date'] = 'incorrect date';
            $valid = false;
        }elseif($dates[1] < (int)substr(date('Y'), 2)){//check if year value is not less than current year
            $_SESSION['validation']['expiry_date'] = 'card expired';
            $valid = false;
        }elseif(strlen($post['expiry_date']) != 5){//check if expiry date contains 5 values
            $_SESSION['validation']['expiry_date'] = 'invalid date';
            $valid = false;
        }
        //validate CVV == digits and length == 3
        if (!preg_match("/^\\d+$/", $post['cvv']) || strlen($post['cvv']) != 3) {
            $_SESSION['validation']['cvv'] = 'invalid cvv';
            $valid = false;
        }
        //validate email address format
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['validation']['email'] = 'Invalid email address';
            $valid = false;
        }
        if($valid == false){
            return false;
        }
        $cart = $this->checkoutModel->allWhereIdSingleEqual('cart', 'created_by', $this->customer, 'status', 'waiting');
        if(empty($cart)){
            $this->swal('error','error','cart not found');
            return false;
        }
        $cart_contents = $this->checkoutModel->getCartContents($cart['id']);
        if(!$this->checkoutModel->completeTransaction($this->customer,$cart['id'],$post) || !$cart_contents){
            $this->swal('error','error occured','transaction could not be completed. try again or contact admin');
            return false;
        }
        $this->sendEmail($cart_contents,$post);
        $this->swal('success','thank you for shopping with us','transaction processed successfuly');
        return true;
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

    public function sendEmail($contents, $post){
        $to = $post['email'];
        $subject = 'PH-ECommerce electronic receipt';
        $tr = '';
        for ($i=0; $i < count($contents); $i++) { 
            $style = $i == 0 || $i % 2 == 0 ? 'background-color:#dddddd' : '';
            $tr .= '<tr style="'.$style.'">';
            $tr .= '<td>'.$contents[$i]['name'].' ('.$contents[$i]['colour'].')('.$contents[$i]['size'].')</td>';
            $tr .= '<td>R '.number_format($contents[$i]['price'],2,'.',',').'</td>';
            $tr .= '<td></td>';
            $tr .= '</tr>';
        }
        $message = '
            <html>
            <head>
            <title>Thank You!</title>
            </head>
            <body>
            <h4>Hi ' . $_SESSION['names'] . '! Thank you for shopping with us!</h4>
            <h6>here is your receipt</h6>
            <table style="border-collapse:collapse,width:100%">
            <tr>
                <th colspan="2" style="border:1px solid #ddd;padding:8px;text-align:center">PH-Ecommerce Transaction #CartID</th>
            </tr>
            '.$tr.'
            </table>
            <br/>
            <strong>if this is not meant for you, please contact us at +27 112 321 0011</strong>
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