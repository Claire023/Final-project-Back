<?php

use Classes\ProductSubCategory;

Class ProductModel extends MainModel {


   //Retour la liste entiere de tout produit avec categories/sous-catégories

       public function getAll() {
         $productList = array();
         $sql = "SELECT a.ID , a.name, a.description, a.id_cat, a.id_sub_category, b.name as 'category_name', c.name as 'sub_category_name'
         FROM Products a INNER JOIN product_category b ON a.id_cat = b.ID LEFT JOIN product_sub_category c ON a.id_sub_category = c.ID ORDER BY b.ID, c.id" ;

//          foreach($datas as $value){
//          $productList[] = Product::feedProduct($value);
//          }
         return $this->makeSelect($sql);;
       }


       //Retour la liste entiere de tout produit avec categories/sous-catégories
       public function getAllForMenu() {
           $productMenuList = array();
           $sql = "SELECT a.ID , a.name, a.description, a.id_cat, a.id_sub_category, b.name as 'category_name', c.name as 'sub_category_name'
         FROM Products a INNER JOIN product_category b ON a.id_cat = b.ID LEFT JOIN product_sub_category c ON a.id_sub_category = c.ID ORDER BY b.ID, c.id" ;
           $datas = $this->makeSelect($sql);
            foreach($datas as $value){
               $productMenuList[] = Product::feedProduct($value);
                    }
           return $productMenuList;
}


public function getProductById($id){
    $sql = $sql = "SELECT a.ID , a.name, a.description, a.id_cat, a.id_sub_category, b.name as 'category_name', c.name as 'sub_category_name'
         FROM Products a
        INNER JOIN product_category b ON a.id_cat = b.ID
        LEFT JOIN product_sub_category c ON a.id_sub_category = c.ID
        WHERE  a.ID=:id;";
    $param = ['id' => $id];
    $data = $this->makeSelect($sql,$param);
    if(sizeof($data) != 0) {
        return $data[0];
    } else {
        throw new Exception('Le produit que vous recherchez n\'existe pas');
    }

}


//Edite un  produit
public function updateProduct($tab){
        $e ='';


        $req ="UPDATE Products SET
    name = :name,
    description = :description,
    id_cat = :id_cat,
    id_sub_category= :id_sub_category
    WHERE ID = :ID;";
        $param = [
            'ID' => $tab['ID'],
            'name' => $tab['name'] ,
            'description' => $tab['description'],
            'id_cat' => $tab['id_cat'],
            'id_sub_category' => $tab['id_sub_category']
        ];
        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
}



public function addProduct($tab){
        $e ='';
        $param = ['name' => $tab['name'], 'description' => $tab['description'] ,  'id_cat' => $tab['id_cat'], 'id_sub_category' => $tab['id_sub_category']];
        $req = 'INSERT INTO `Products` (name, description, id_cat, id_sub_category) VALUES (:name,:description, :id_cat, :id_sub_category);';

        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
    }


//     je récupère les catégories pour lfaire un select dynamique coté front pour ajouter les bonnes categories
    public function getCategoryList(){
            $categoryList = array();
            $sql = 'SELECT * FROM product_category';
            $datas = $this->makeSelect($sql);
            foreach($datas as $value){
                $categoryList[] = ProductCategory::feedProductCategory($value);
            }
            return $categoryList;
        }



        //je récupère mes sous-catégories pour faire un select dynamique dans mon formulaire coté angular
        public function getSubCategoryList(){
            $subCategoryList = array();
            $sql = 'SELECT * FROM product_sub_category';
            $datas = $this->makeSelect($sql);
            foreach($datas as $value){
                $subCategoryList[] = ProductSubCategory::feedProductSubCategory($value);
            }
            return $subCategoryList;
        }


//Je supprime un produit en fonction de son ID
        public function deleteProduct($id){
            $sql = 'DELETE FROM Products WHERE ID=:id';
            $param = array('id'=>$id);
             if($this->makeStatement($sql,$param)){
                return true;
            }
            return false;
        }




        public function addCategory($tab){
            $e ='';
            $param = ['name' => $tab['name']];
            $req = 'INSERT INTO `product_category` (name) VALUES (:name);';

            try{
                $this->makeStatement($req,$param);
            }catch(PDOexception $e){}

            return $e;

        }









    }

