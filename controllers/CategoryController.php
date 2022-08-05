<?php
class CategoryController {
    public function __construct(){
        $this->categoryModel = Library\Helper::model(Library\Helper::route());
        $this->category = Library\Helper::attributeId();
    }

    public function view(){
        if($this->category){
            $cat = $this->categoryModel->allWhereIdSingle('categories','cat_name',$this->category);
            if($cat){
                $data = $this->categoryModel->allWhereIdRows('products','category',$cat['id']);
            }
        }else{
            header('location:/ecommerce/');
        }
        require('./views/category.php');
    }
}