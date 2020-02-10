<?php

class globalSubCategory implements JsonSerializable {

    private $id;
    private $name;
    private  $main_cat;
    private $name_cat;


    public function __constructor(){

    }


     public static function feedGlobalProductSubCategory(array $fGlobalSubCategory){

       $globalSubCategory = new self();
       //On vérifie l'existence de l'attribut ID
       if(isset($fGlobalSubCategory['ID'])){
        $globalSubCategory->setId($fGlobalSubCategory['ID']);
        }
        $globalSubCategory->setName($fGlobalSubCategory['name']);
        $globalSubCategory->setMain_cat($fGlobalSubCategory['main_cat']);
        $globalSubCategory->setName_cat($fGlobalSubCategory['name_cat']);

        return $globalSubCategory;
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
     * @return mixed
     */
    public function getName_cat()
    {
        return $this->name_cat;
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

    /**
     * @param mixed $name_cat
     */
    public function setName_cat($name_cat)
    {
        $this->name_cat = $name_cat;
    }


    public function jsonSerialize() {
        return [
            //a gauche coté database et à droite récupère dans les setters
            'ID' => $this->id,
            'name' => $this->name,
            'main_cat' => $this->main_cat,
            'name_cat' => $this->name_cat

        ];
    }


}

