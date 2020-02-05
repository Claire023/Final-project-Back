<?php

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


//Edite un  produit
public function updateProduct($tab){
        $e ='';
        $param = [
            'ID' => $tab['ID'],
            'name' => $tab['name'] ,
            'description' => $tab['description'],
            'id_cat' => $tab['id_cat'],
            'id_sub_cat' => $tab['id_sub_cat']
        ];

        $req ="UPDATE Products SET
    name = :name,
    description = :description,
    id_cat = :id-cat,
    id_sub_cat= :id_sub_cat
    WHERE ID = :ID;";

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


    /*
     * Met à jour mes produits dans la table
     */
   /*  public function updateProduct($tab) {
        $e ='';
        $param = ['name' => $tab['name'], 'description' => $tab['description'] ,  'price' => $tab['price'], 'category' => $tab['category'], 'sub_category' => $tab['sub_category']];
        $req = "UPDATE Products SET (name, description, price, category, sub_category) WHERE ID => " + $tab['ID'] + ";";

        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
    } */



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

    }




