<?php


class User implements JsonSerializable {

    private $id;
    private $pseudo;
    private $mail;
    private $password;


    public function __constructor(){

    }


    public static function feedUser(array $fUser){

        $user = new self();
        $user->setId($fUser['u_id']);
        $user->setPseudo($fUser['pseudo']);
        $user->setMail($fUser['mail']);
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
    public function getPseudo()
    {
        return $this->pseudo;
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
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
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
            'pseudo' => $this->pseudo,
            'mail' => $this->mail,
            'password' => $this->password,
        ];
    }


}

