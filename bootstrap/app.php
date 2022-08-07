<?php
    require_once('./config/core.php');
    require_once('./library/helper.php');

    $active = Library\Helper::route() == 'category' ? Library\Helper::attributeId() : Library\Helper::route();
    

    include './views/layouts/header.php';
    /*
        if customer is logged in they should not be able to go to "/Login" or "/Register"
    */
    if (Library\Helper::route() == 'login' || Library\Helper::route() == 'register') {
        if (isset($_SESSION['customer']) && $_SESSION['customer']['loggedIn']) {
            header('location:/ecommerce/');
        }
    }
    /* 
        if current directory has a class, a view exists, else view "404.php"
    */
    if(file_exists('./Controllers/' . ucfirst(Library\Helper::route()) .'Controller.php')){
        $ctrlName = ucfirst(Library\Helper::route()) . 'Controller';
        require_once('./controllers/' . $ctrlName . '.php');
        $controller = new $ctrlName;
        $controller->view();
    }else{
        if(Library\Helper::route() == 'logout'){
            session_destroy();
            header('location:/ecommerce/');
        }else{
            include './views/404.php';
        }
    }
    include './views/layouts/footer.php';
    include './library/session.php';
?>