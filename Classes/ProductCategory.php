<?php


class ProductCategory implements JsonSerializable {

    private $id;
    private $name;


    public function __constructor(){

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

    public static function feedProductCategory(array $fProductCategory){

        $productCategory = new self();
        //On vérifie l'existence de l'attribut ID
        if(isset($fProductCategory['ID'])){
            $productCategory->setId($fProductCategory['ID']);
        }
        $productCategory->setName($fProductCategory['name']);

        return $productCategory;
    }


    public static function feedProductSubCategory(array $fProductCategory){

        $productCategory = new self();
        //On vérifie l'existence de l'attribut ID
        if(isset($fProductCategory['ID'])){
            $productCategory->setId($fProductCategory['ID']);
        }
        $productCategory->setName($fProductCategory['name']);

        return $productCategory;
    }






    public function jsonSerialize() {

        return [
            //a gauche coté database et à droite récupère dans les setters
            'ID' => $this->id,
            'name' => $this->name,

        ];
    }







}

