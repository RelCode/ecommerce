<?php
class Database{
    private $host = 'localhost';
    private $dbname = 'ecommerce';
    private $user = 'root';
    private $password = '';
    public $db;
    //creates a db connection object
    public function __construct(){
        try{
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo 'DB Connection Error: ' . $exception;
        }
    }
    
    //shorthand method used to execute a query & fetch rows
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
    //fetches a row where an value match a single record
    public function allWhereIdSingle($table,$column,$value){
        $query = 'SELECT * FROM '.$table.' WHERE '.$column.' = :value LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':value',$value);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    //fetches a row where 1 or 2 columns values matches 1 or 2 provided values
    public function allWhereIdSingleEqual($table,$column1,$value1,$column2,$value2,$condition = '='){
        $query = 'SELECT * FROM '.$table.' WHERE '.$column1.' = :value1 AND '.$column2.' '.$condition.' :value2 LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':value1', $value1);
        $stmt->bindParam(':value2', $value2);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    //fetches all rows where a value matches multiple records
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