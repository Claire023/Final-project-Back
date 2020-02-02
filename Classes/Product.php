<?php

class Product implements  JsonSerializable {

    private $id;
    private $name;
    private $description;
    private $id_cat;
    private $id_sub_category;
    private $category_name;
    private $sub_category_name;

    public function __constructor(){

    }


    public static function feedProduct(array $fProduct){

        $product = new self();
        //On vérifie l'existence de l'attribut ID
        if(isset($fProduct['ID'])){
            $product->setId($fProduct['ID']);
        }
        $product->setName($fProduct['name']);
        $product->setDescription($fProduct['description']);
        $product->setId_cat($fProduct['id_cat']);
        $product->setId_sub_category($fProduct['id_sub_category']);
        $product->setCategory_name($fProduct['category_name']);
        $product->setSub_category_name($fProduct['sub_category_name']);

        return $product;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getId_cat()
    {
        return $this->id_cat;
    }

    /**
     * @return mixed
     */
    public function getId_sub_category()
    {
        return $this->id_sub_category;
    }

    /**
     * @return mixed
     */
    public function getCategory_name()
    {
        return $this->category_name;
    }

    /**
     * @return mixed
     */
    public function getSub_category_name()
    {
        return $this->sub_category_name;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $id_cat
     */
    public function setId_cat($id_cat)
    {
        $this->id_cat = $id_cat;
    }

    /**
     * @param mixed $id_sub_category
     */
    public function setId_sub_category($id_sub_category)
    {
        $this->id_sub_category = $id_sub_category;
    }

    /**
     * @param mixed $category_name
     */
    public function setCategory_name($category_name)
    {
        $this->category_name = $category_name;
    }

    /**
     * @param mixed $sub_category_name
     */
    public function setSub_category_name($sub_category_name)
    {
        $this->sub_category_name = $sub_category_name;
    }



    public function jsonSerialize() {

        return [
            //a gauche coté database et à droite récupère dans les setters
            'ID' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'id_cat' => $this->id_cat,
            'id_sub_category' => $this->id_sub_category,
            'category_name' => $this->category_name,
            'sub_category_name' => $this->sub_category_name,
        ];
    }

}

