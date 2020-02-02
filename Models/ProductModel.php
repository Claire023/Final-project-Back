<?php

Class ProductModel extends MainModel {



   //Retour la liste entiere de tout produit avec categories/sous-catégories

       public function getAll() {
         $productList = array();
         $sql = "SELECT a.ID , a.name, a.description, a.id_cat, a.id_sub_category, b.name as 'category_name', c.name as 'sub_category_name'
         FROM Products a INNER JOIN product_category b ON a.id_cat = b.ID LEFT JOIN product_sub_category c ON a.id_sub_category = c.ID ORDER BY b.ID, c.id" ;
         $datas = $this->makeSelect($sql);
         foreach($datas as $value){
         $productList[] = Product::feedProduct($value);
         }
         return $productList;
       }


    /*
     * retourne la liste complète des produits du menu
     */
 /*    public function getProductList() {
        $productList = array();
        $sql = 'SELECT * FROM Products';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $productList[] = Product::feedProduct($value);
        }
        return $productList;
    } */

    /*
     * retourne la liste complète des catégories de produits du menu
     */
/*     public function getProductCategoryList() {
        $productCategoryList = array();
        $sql = 'SELECT * FROM product_category';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $productCategoryList[] = ProductCategory::feedProductCategory($value);
        }
        return $productCategoryList;
    } */





    /*
     * retourne la liste des sous-catégories de produits de boissons
     */
  /*   public function getDrinkSubCategoryList() {
        $drinkSubCategoryList = array();
        $sql = 'SELECT DISTINCT sub_category FROM Products WHERE category="nuestras bebidas - Nos Boissons"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $drinkSubCategoryList[] = Product::feedSubCategory($value);
        }
        return $drinkSubCategoryList;
    } */


    /*
     * retourne la liste des sous-catégories de produits des entrées du menu
     */
  /*   public function getStarterSubCategoryList() {
        $starterSubCategoryList = array();
        $sql = 'SELECT DISTINCT sub_category FROM Products WHERE category="NUESTRAS ENTRADAS - Nos Entrées"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $starterSubCategoryList[] = Product::feedSubCategory($value);
        }
        return $starterSubCategoryList;
    } */


    /*
     * retourne la liste des sous-catégories de produits des plats du menu
     */
/*     public function getMainSubCategoryList() {
        $mainSubCategoryList = array();
        $sql = 'SELECT DISTINCT sub_category FROM Products WHERE category="NUESTROS PLATOS - Nos Plats"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $mainSubCategoryList[] = Product::feedSubCategory($value);
        }
        return $mainSubCategoryList;
    } */


    /*
     * retourne la liste des sous-catégories de desserts
     */
/*     public function getDessertSubCategoryList() {
        $dessertSubCategoryList = array();
        $sql = 'SELECT DISTINCT sub_category FROM Products WHERE category="NUESTROS POSTRES - Nos Desserts"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $dessertSubCategoryList[] = Product::feedSubCategory($value);
        }
        return $dessertSubCategoryList;
    } */


    /*
     * retourne la liste des sous-catégories de digestifs
     */
  /*   public function getDigSubCategoryList() {
        $digSubCategoryList = array();
        $sql = 'SELECT DISTINCT sub_category FROM Products WHERE category="NUESTROS CAFFECITOS - Nos Cafés & Thés"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $digSubCategoryList[] = Product::feedSubCategory($value);
        }
        return $digSubCategoryList;
    } */




    /*
     * Test pour récupérer les entrées et leur sous catégories
     */
    /* public function getStarter() {
        $starterList = array();
        $sql = 'SELECT * FROM Products WHERE category="NUESTRAS ENTRADAS - Nos Entrées"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $starterList[] = Product::feedProduct($value);
        }
        return $starterList;
    } */


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

}
