<?php
require_once('./config/database.php');
class Search extends Database {
    public function searchForProducts($string,$page){
        $data = [];
        $string = '%'.$string.'%';
        $per_page = 5;
        $from = ($per_page * $page) - $per_page;
        $query = 'SELECT * FROM products WHERE name LIKE :string LIMIT '.$from.', '.$per_page.'';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':string',$string);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data, $row);
            }
        }
        return $data;
    }

    public function countMatchingProducts($string){
        $string = '%'.$string.'%';
        $query = 'SELECT * FROM products WHERE name LIKE :string';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':string',$string);
        $stmt->execute();
        return $stmt->rowCount();
    }
}