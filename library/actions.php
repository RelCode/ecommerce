<?php
    session_start();
    require_once('./../config/database.php');
    $database = new Database();
    $db = $database->db;

    $action = $_GET['action'];
    if($action == 'cartItemsCount'){
        echo $database->cartCount();
        exit();
    }elseif($action == 'fetchProvinces'){
        $data = [];
        $query = 'SELECT * FROM provinces ORDER BY name ASC';
        $stmt = $db->query($query);
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                array_push($data,$row);
            }
        }
        echo json_encode($data);
        exit();
    }elseif($action == 'fetchCities'){
        $data = [];
        $province = $_GET['where'];
        $query = 'SELECT * FROM cities WHERE province = :province ORDER BY name ASC';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':province',$province);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                array_push($data,$row);
            }
        }
        echo json_encode($data);
        exit();
    }