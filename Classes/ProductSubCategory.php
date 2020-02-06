<?php
namespace Classes;

use JsonSerializable;

class ProductSubCategory implements JsonSerializable
{

    private $id;
    private $name;
    private  $main_cat;

 public function __constructor(){

    }


 public static function feedProductSubCategory(array $fProductSubCategory){

        $productSubCategory = new self();
        //On vérifie l'existence de l'attribut ID
        if(isset($fProductSubCategory['ID'])){
            $productSubCategory->setId($fProductSubCategory['ID']);
        }
        $productSubCategory->setName($fProductSubCategory['name']);
        $productSubCategory->setMain_cat($fProductSubCategory['main_cat']);

        return $productSubCategory;
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
    public function getMain_cat()
    {
        return $this->main_cat;
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
     * @param mixed $main_cat
     */
    public function setMain_cat($main_cat)
    {
        $this->main_cat = $main_cat;
    }





    public function jsonSerialize() {

        return [
            //a gauche coté database et à droite récupère dans les setters
            'ID' => $this->id,
            'name' => $this->name,
            'main_cat' => $this->main_cat,

        ];
    }







}

