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


//On récpère par ID pour faire un edit des produit par ID
 public function getProductById(){
     $productModel = new ProductModel();
     try {
         $product = $productModel->getProductById($this->parameters['ID']);
         $this->JsonCall($product);

     } catch(Exception $e) {
         $this->JsonCall(['error'=>$e->getMessage()], HttpCode::NO_CONTENT);

     }

 }


 public function updateProduct(){
     echo "On est dans updatePro";
     $productModel = new ProductModel();
    $updatedProduct =  $productModel->updateProduct($this->data);
     $this->JsonCall($updatedProduct);
 }


 public function addProduct(){
     $productModel = new productModel();
     $productModel->addProduct($this->data);
     $this->JsonCall($this->data);
 }



 public function deleteProduct(){
     $productModel = new ProductModel();
     if($productModel->deleteProduct($this->parameters['ID'])){
         header('Location:index.php?controller=product&action=getAll');
     }
     else{
         echo "error";
     }
 }


//Pour faire un select  dynamique dans le formulaire d'ajout de produit
 public function getCategory(){
     $productModel = new productModel();
     $categories = $productModel->getCategoryList();
     $this->JsonCall($categories);
 }


 public function addCategory(){
     $productModel = new productModel();
     $productModel->addCategory($this->data);
     $this->JsonCall($this->data);
 }




 //Pour faire un select  dynamique dans le formulaire d'ajout de produit
 public function getSubCategory(){
     $productModel = new productModel();
     $subCategories = $productModel->getSubCategoryList($this->data);
     $this->JsonCall($subCategories);
 }


}