<?php


class User implements JsonSerializable {
    //JSONSERALIZABLE est une interface native de php et a partir du moment ou tu l'implémente tu est obligé d'implémenter une function jsonSerialize
    //car c'est dans le contrat

    //j'ai crée des attributs en privé par sécurité et intégrité
    private $id;
    private $mail;
    private $password;
    private $isAdmin;



    public function __constructor(){

    }


    //hydratation
    //permet de créer un user a partir d'un tableau
    //c'est la methode qui instancie le user en s'alimentant à partir du tableau
    public static function feedUser(array $fUser){

        $user = new self();
        //On vérifie l'existence de l'attribut ID
        if(isset($fUser['u_id'])){
         //si case u_ID je set u_id
        $user->setId($fUser['u_id']);
        }
        $user->setMail($fUser['email']);
        $user->setPassword($fUser['password']);
        $user->setIsAdmin($fUser['isAdmin'] == 1 ? true : false);

        return $user;
    }


    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function toString(){
        return $this->mail;
    }


    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
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
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    // vu que les attrbiuts sont en private On est obligé de dire à json comment il doit bosser
    //on crée un tableau et on lui dit dedans d'aller chercher les attributs
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'mail' => $this->mail,
            'password' => $this->password,
        ];
    }

}

