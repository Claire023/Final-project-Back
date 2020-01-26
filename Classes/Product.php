<?php

class Product implements  JsonSerializable {

    private $id;
    private $name;
    private $description;
    private $price;
    private $category;
    private $sub_category;



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
        $product->setPrice($fProduct['price']);
        $product->setCategory($fProduct['category']);
        $product->setSub_category($fProduct['sub_category']);

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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getSub_category()
    {
        return $this->sub_category;
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
     * @param mixed $desc
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param mixed $sub_category
     */
    public function setSub_category($sub_category)
    {
        $this->sub_category = $sub_category;
    }


    public function jsonSerialize() {

        return [
            //a gauche coté database et à droite récupère dans les setters
            'ID' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
        ];
    }

}

