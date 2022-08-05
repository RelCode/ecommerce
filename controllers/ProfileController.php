<?php
class ProfileController {
    public function __construct(){
        $this->profileModel = Library\Helper::model(Library\Helper::route());
    }

    public function view(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->store($_POST);
        }
        if($_SESSION['customer']['hasProfile'] == 'Y'){
            $profile = $this->profileModel->getUserProfile($_SESSION['customer']['id']);
            // var_dump($profile);
        }
        require('./views/profile.php');
    }

    public function store($post){
        $this->oldValues($post);
        //ensure anti-csrf is enforced
        if($post['csrf-token'] != $_SESSION['csrf']['token']){
            $this->error('danger','invalid request');
            return false;
        }
        //check if the province selected exists
        if(empty($this->profileModel->allWhereIdSingle('provinces','id',$post['province']))){
            $_SESSION['validation']['province'] = 'invalid province selection';
            return false;
        }
        //check if the selected city exists and within the selected province
        if(empty($this->profileModel->allWhereIdSingleEqual('cities','id',$post['city'],'province',$post['province']))){
            $_SESSION['validation']['city'] = 'invalid city selected';
            return false;
        }
        //test if zip code contains numbers only
        if(!preg_match("/^\\d+$/",$post['zip'])){
            $_SESSION['validation']['zip'] = 'invalid zip';
            return false;
        }
        $create = $this->profileModel->createProfile($post);
        if($create == '500'){
            $this->error('danger','error occured. try again');
            return false;
        }
        $this->error('success','changes saved');
        $_SESSION['customer']['hasProfile'] = 'Y';
        return true;
    }

    public function error($class,$message){
        $_SESSION['error']['class'] = $class;
        $_SESSION['error']['message'] = $message;
        return true;
    }

    public function oldValues($post){
        $_SESSION['old']['address'] = $post['address'];
        $_SESSION['old']['phone'] = $post['phone'];
        $_SESSION['old']['zip'] = $post['zip'];
        return true;
    }
}