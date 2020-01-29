<?php

include('./Classes/Product.php');
include('./Classes/ProductCategory.php');
include('./Models/ProductModel.php');


Class ProductController extends MainController {


    //Obtenir la liste des produits pour les afficher dans le menu

    public function getProductList(){

        $productModel = new ProductModel();
        $products = $productModel->getProductList();
        $this->JsonCall($products);
    }


    //Obtenir la liste des catégories de produits pour les afficher dans le menu

    public function getProductCategoryList(){

        $productModel = new ProductModel();
        $productCategory = $productModel->getProductCategoryList();
        $this->JsonCall($productCategory);
    }


    //Obtenir la liste des sous-catégories de boissons
    public function getDrinkCategoryList(){
        $productModel = new ProductModel();
        $drinkSubCategory = $productModel->getDrinkSubCategoryList();
        $this->JsonCall($drinkSubCategory);
    }


   //Obtenir la liste des  sous-catégories pour les entrées
    public function getStarterCategoryList(){
        $productModel = new ProductModel();
        $starterSubCategory = $productModel->getStarterSubCategoryList();
        $this->JsonCall($starterSubCategory);
    }



    //Obtenir la liste des sous-catégories pour les plats
    public function getMainCategoryList(){
        $productModel = new ProductModel();
        $mainSubCategory = $productModel->getMainSubCategoryList();
        $this->JsonCall($mainSubCategory);
    }


    //Obtenir la liste des sous-catégories pour desserts
    public function getDessertCategoryList(){
        $productModel = new ProductModel();
        $dessertSubCategory = $productModel->getDessertSubCategoryList();
        $this->JsonCall($dessertSubCategory);
    }


    //Obtenir la liste des sous-catégories pour les digestifs
    public function getDigCategoryList(){
        $productModel = new ProductModel();
        $digSubCategory = $productModel->getDigSubCategoryList();
        $this->JsonCall($digSubCategory);
    }




    //Test pour extraire les entrées
    public function getStarterList(){
        $productModel = new ProductModel();
        $starterCategory = $productModel->getStarter();
        $this->JsonCall($starterCategory);
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