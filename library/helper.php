<?php
    namespace Library;
    class Helper {
        // public $directory;
        public function __construct(){
            // $uri = explode('/',$_SERVER['REQUEST_URI']);
            // $this->directory = $uri[2] == '' || $uri[2] == 'home' ? 'home' : $uri[2];//www.commerce.com/[home]
            // $this->subdirectory = isset($uri[3]) ? '/' . $uri[3] : '';//[shoes]/[men,women,kids]
            // $this->path = isset($uri[4]) ? '/' . $uri[4] : '';//[shoes][men][productId]
        }

        public static function route(){
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            $directory = $uri[2] == '' || $uri[2] == 'home' ? 'home' : $uri[2];//www.commerce.com/[home]
            return $directory;
        }

        public static function attributeId(){
            $id = explode('/',$_SERVER['REQUEST_URI'])[3];
            return $id;
        }

        public static function model($model){
            require_once('./models/'.ucfirst($model).'.php');
            return new $model;
        }
    }
?>