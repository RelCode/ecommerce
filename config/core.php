<?php
session_start();
//create a token that will be used as anti-CSRF measure
if(!isset($_SESSION['csrf']['token'])){
    $_SESSION['csrf']['token'] = bin2hex(openssl_random_pseudo_bytes(32));
}
//creates a temporary ID for users that are not logged in
if(!isset($_SESSION['customer']) && !isset($_COOKIE['visitor'])){
    $name = 'visitor';
    $value = uniqid();
    setcookie($name,$value,time() + (86400 * 5));
}

// if(!)