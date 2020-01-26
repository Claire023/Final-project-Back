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
