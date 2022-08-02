<?php
class Database{
    private $host = 'localhost';
    private $dbname = 'ecommerce';
    private $user = 'root';
    private $password = '';
    public $db;

    public function __construct(){
        try{
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo 'DB Connection Error: ' . $exception;
        }
    }

    public function allRows($query){
        $data = [];
        $stmt = $this->db->query($query);
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data,$row);
            }
        }
        return $data;
    }

    public function allWhereIdRows($table,$column,$value){
        $data = [];
        $query = 'SELECT * FROM '.$table.' WHERE '.$column.' = :value';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':value',$value);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data,$row);
            }
        }
        return $data;
    }
}
date_default_timezone_set('Africa/Johannesburg');