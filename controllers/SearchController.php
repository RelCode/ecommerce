<?php
class SearchController {
    public function __construct(){
        $this->searchModel = Library\Helper::model(Library\Helper::route());
        $this->string = isset($_GET['query']) ? $_GET['query'] : '';
        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
    }

    public function view(){
        if($this->string == ''){
            echo '<script>history.back()</script>';
        }
        // var_dump($_POST);
        if($this->page == 1 && $_SESSION['csrf']['token'] != $_POST['csrf-token']){
            $_SESSION['alert']['message'] = 'invalid request';
            $data = [];
        }else{
            $data = $this->searchModel->searchForProducts($this->string,$this->page);
            $data['count'] = $this->searchModel->countMatchingProducts($this->string);
            if($data['count'] == 0){
                $_SESSION['alert']['message'] = 'no matching product found';
            }
        }
        require('./views/search.php');
    }
}