<?php

include('./Classes/Product.php');
include('./Models/ProductModel.php');


Class ProductController extends MainController {


    //Obtenir la liste des produits pour les afficher dans le menu

    public function getProductList(){

        $productModel = new ProductModel();
        $products = $productModel->getProductList();
        $this->JsonCall($products);
    }


    public function updateProduct(){

        $productModel = new ProductModel();
        //récupère le token from index.php
        if($this->isAdmin()){
            $this->JsonCall($this->payload);
        } else {
            $this->JsonCall(Array(
                'message' => "Echec de l'update"
            ), 401);
        }
    }

}