<?php

Class ProductModel extends MainModel {

    /*
     * retourne la liste complète des produits du menu
     */
    public function getProductList() {
        $productList = array();
        $sql = 'SELECT * FROM Products';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $productList[] = Product::feedProduct($value);
        }
        return $productList;
    }

    /*
     * retourne la liste complète des catégories de produits du menu
     */
    public function getProductCategoryList() {
        $productCategoryList = array();
        $sql = 'SELECT * FROM product_category';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $productCategoryList[] = ProductCategory::feedProductCategory($value);
        }
        return $productCategoryList;
    }

    /*
     * retourne la liste des sous-catégories de produits de boissons
     */
    public function getDrinkSubCategoryList() {
        $drinkSubCategoryList = array();
        $sql = 'SELECT DISTINCT sub_category FROM Products WHERE category="nuestras bebidas - Nos Boissons"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $drinkSubCategoryList[] = Product::feedSubCategory($value);
        }
        return $drinkSubCategoryList;
    }


    /*
     * retourne la liste des sous-catégories de produits des entrées du menu
     */
    public function getStarterSubCategoryList() {
        $starterSubCategoryList = array();
        $sql = 'SELECT DISTINCT sub_category FROM Products WHERE category="NUESTRAS ENTRADAS - Nos Entrées"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $starterSubCategoryList[] = Product::feedSubCategory($value);
        }
        return $starterSubCategoryList;
    }


    /*
     * retourne la liste des sous-catégories de produits des plats du menu
     */
    public function getMainSubCategoryList() {
        $mainSubCategoryList = array();
        $sql = 'SELECT DISTINCT sub_category FROM Products WHERE category="NUESTROS PLATOS - Nos Plats"';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $mainSubCategoryList[] = Product::feedSubCategory($value);
        }
        return $mainSubCategoryList;
    }


    /*
     * Met à jour mes produits dans la table
     */
    public function updateProduct($tab) {
        $e ='';
        $param = ['name' => $tab['name'], 'description' => $tab['description'] ,  'price' => $tab['price'], 'category' => $tab['category'], 'sub_category' => $tab['sub_category']];
        $req = "UPDATE Products SET (name, description, price, category, sub_category) WHERE ID => " + $tab['ID'] + ";";

        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
    }

}
