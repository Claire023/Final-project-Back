<?php

include('./Classes/Product.php');
include('./Classes/ProductCategory.php');
include('./Classes/ProductSubCategory.php');
include('./Classes/globalSubCategory.php');
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

        // récupère tout mes produits avec sous-catégores et catégories correspondante également mais classe par catégorie et sous-catégories pour mieux voir dans le menu
    public function getAllForMenu()
    {
        $productModel = new ProductModel();
        $productMenu = $productModel->getAllForMenu();
        $data = [];

        // permet récupération dynamique des données
        foreach ($productMenu as $value) {
            if (! empty($value->getSub_category_name())) {
                $data[$value->getCategory_name()][$value->getSub_category_name()][] = $value;
            } else {
                $data[$value->getCategory_name()][] = $value;
            }
        }
        $this->JsonCall($data);
    }

        // On récpère par ID pour faire un edit des produit par ID
    public function getProductById()
    {
        $productModel = new ProductModel();
        try {
            $product = $productModel->getProductById($this->parameters['ID']);
            $this->JsonCall($product);
        } catch (Exception $e) {
            $this->JsonCall([
                'error' => $e->getMessage()
            ], HttpCode::NO_CONTENT);
        }
    }

    public function updateProduct()
    {
        // verification si donnée bien valides
        if (FormValidation::isString($this->data['name']) && FormValidation::isString($this->data['description']) && FormValidation::isNumeric($this->data['id_cat']) && FormValidation::isNumeric($this->data['id_sub_category'])) {

            $productModel = new ProductModel();
            $updatedProduct = $productModel->updateProduct($this->data);
            $this->JsonCall($updatedProduct);
        } else {
            $this->JsonCall(Array(
                'message' => 'Erreur'
            ), HttpCode::UNAUTHORIZED);
        }
    }

 public function addProduct(){
     //verification si donnée bien valides
     if( FormValidation::isString($this->data['name']) && FormValidation::isString($this->data['description'])
            && FormValidation::isNumeric($this->data['id_cat']) &&  FormValidation::isNumeric($this->data['id_sub_category'])){
     $productModel = new productModel();
     $productModel->addProduct($this->data);
     $this->JsonCall($this->data);

     } else {
         $this->JsonCall(Array(
             'message' => 'Erreur'
         ), HttpCode::UNAUTHORIZED);

     }

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

        // Pour faire un select dynamique dans le formulaire d'ajout de produit
    public function getCategory() {
        $productModel = new productModel();
        $categories = $productModel->getCategoryList();
        $this->JsonCall($categories);
    }



 //On récpère par ID pour faire un edit des catégories par ID
 public function getCategoryById(){
     $productModel = new ProductModel();
     try {
         $category = $productModel->getCategoryById($this->parameters['ID']);
         $this->JsonCall($category);

     } catch(Exception $e) {
         $this->JsonCall(['error'=>$e->getMessage()], HttpCode::NO_CONTENT);
     }
 }

        // edite la catégorie séléctionnée
    public function updateCategory(){
        if (FormValidation::isString($this->data['name'])) {
            $productModel = new ProductModel();
            $updatedCategory = $productModel->updateCategory($this->data);
            $this->JsonCall($updatedCategory);
        } else {
            $this->JsonCall(Array(
                'message' => 'Erreur'
            ), HttpCode::UNAUTHORIZED);
        }
    }


 public function addCategory(){

     //verification si donnée bien valides
     if( FormValidation::isString($this->data['name'])){

         $productModel = new productModel();
         $productModel->addCategory($this->data);
         $this->JsonCall($this->data);

     } else {
         $this->JsonCall(Array(
             'message' => 'Erreur'
         ), HttpCode::UNAUTHORIZED);
     }

 }



 public function deleteCategory(){
     $productModel = new ProductModel();
     if($productModel->deleteCategory($this->parameters['ID'])){
         header('Location:index.php?controller=product&action=getCategory');
     }
     else{
         echo "error";
     }
 }


 //Pour faire un select  dynamique dans le formulaire d'ajout de produit
 public function getSubCategory(){
     $productModel = new productModel();
     $subCategories = $productModel->getSubCategoryList($this->data);
     $this->JsonCall($subCategories);
 }


 //Pour afficher dynamiquement les données des sous catégories avec les catégories associées
 public function getGlogalSubCategory(){
     $productModel = new productModel();
     $subCategories = $productModel->getGlobalSubCategory();
     $this->JsonCall($subCategories);
 }


 public function getSubCategoryById(){
     $productModel = new ProductModel();
     try {
         $subCategory = $productModel->getSubCategoryById($this->parameters['ID']);
         $this->JsonCall($subCategory);
     } catch(Exception $e) {
         $this->JsonCall(['error'=>$e->getMessage()], HttpCode::NO_CONTENT);
     }
 }


 public function updateSubCategory(){
     if( FormValidation::isString($this->data['name']) && FormValidation::isNumeric($this->data['main_cat'])){
     $productModel = new ProductModel();
     $updatedSubCategory =  $productModel->updateSubCategory($this->data);
     $this->JsonCall($updatedSubCategory);

     }else {
         $this->JsonCall(Array(
             'message' => 'Erreur'
         ), HttpCode::UNAUTHORIZED);

     }
 }


 public function addSubCategory(){

     //verification si donnée bien valides
     if( FormValidation::isString($this->data['name']) && FormValidation::isNumeric($this->data['main_cat'])){
     $productModel = new productModel();
     $productModel->addSubCategory($this->data);
     $this->JsonCall($this->data);

     } else {
         $this->JsonCall(Array(
             'message' => 'Erreur'
         ), HttpCode::UNAUTHORIZED);
     }
 }



 public function deleteSubCategory(){
     $productModel = new ProductModel();
     if($productModel->deleteSubCategory($this->parameters['ID'])){
         header('Location:index.php?controller=product&action=getGlogalSubCategory');
     }
     else{
         echo "error";
     }
 }










}