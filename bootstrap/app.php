<?php
    include './views/layouts/header.php';

    require_once('./library/helper.php');
    if(file_exists('./Controllers/' . ucfirst(Library\Helper::route()) .'Controller.php')){
        $ctrlName = ucfirst(Library\Helper::route()) . 'Controller';
        require_once('./controllers/' . $ctrlName . '.php');
        $controller = new $ctrlName;
        $controller->view();
    }else{
        include './views/404.php';
    }
    include './library/session.php';
    include './views/layouts/footer.php';
?>