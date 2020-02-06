<?php

include('./Classes/Product.php');
include('./Classes/ProductCategory.php');
include('./Classes/ProductSubCategory.php');
include('./Models/ProductModel.php');


Class ProductController extends MainController {


    //Obtenir la liste des produits pour les afficher dans le menu

    public function getProductList(){

        $productModel = new ProductModel();
        $products = $productModel->getProductList();
        $this->JsonCall($products);
    }


//récupère tout mes produits avec sous-catégores et catégories correspondante
    public function getAll(){
        $productModel = new ProductModel();
        $products = $productModel->getAll();
        $data = [];
        $this->JsonCall($products);
 }


 //récupère tout mes produits avec sous-catégores et catégories correspondante également mais classe par catégorie et sous-catégories pour mieux voir dans le menu
 public function getAllForMenu(){
     $productModel = new ProductModel();
     $productMenu = $productModel->getAllForMenu();
     $data = [];

    // permet récupération dynamique des données
         foreach($productMenu as $value) {
             if(!empty($value->getSub_category_name())) {
                 $data[$value-> getCategory_name()][$value->getSub_category_name()][] = $value;
             } else {
                 $data[$value->getCategory_name()][] = $value;
             }
     }
     $this->JsonCall($data);
 }


 public function updateProduct(){
     $productModel = new ProductModel();
     $productModel->updateProduct($this->data);
     $this->JsonCall($this->data);
 }


 public function addProduct(){

     $productModel = new productModel();
     $productModel->addProduct($this->data);
     $this->JsonCall($this->data);
 }

//Pour faire un select  dynamique dans le formulaire d'ajout de produit
 public function getCategory(){
     $productModel = new productModel();
     $categories = $productModel->getCategoryList();
     $this->JsonCall($categories);
 }

 //Pour faire un select  dynamique dans le formulaire d'ajout de produit
 public function getSubCategory(){
     $productModel = new productModel();
     $subCategories = $productModel->getSubCategoryList();
     $this->JsonCall($subCategories);
 }



}