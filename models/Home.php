<?php
require_once('./config/database.php');
class Home extends Database {
    public function getProducts(){
        $query = 'SELECT p.id, p.sku, p.name, p.description, p.colour, p.size, p.available_colours, p.available_sizes, p.target, p.unit, p.price, p.thumbnail, c.cat_name, b.brand_name 
            FROM products as p 
            INNER JOIN categories as c 
            ON p.category = c.id 
            INNER JOIN brands as b 
            ON p.brand = b.id';
        return $this->allRows($query);
    }
}