<?php


class User implements JsonSerializable {

    private $id;
    private $mail;
    private $password;


    public function __constructor(){

    }


    public static function feedUser(array $fUser){

        $user = new self();
        //On vérifie l'existence de l'attribut ID
        if(isset($fUser['u_id'])){
        $user->setId($fUser['u_id']);
        }
        $user->setMail($fUser['email']);
        $user->setPassword($fUser['password']);

        return $user;
    }


    public function toString(){
        return $this->mail;
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
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'mail' => $this->mail,
            'password' => $this->password,
        ];
    }


}

