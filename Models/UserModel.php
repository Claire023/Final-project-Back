<?php


class UserModel extends MainModel
{

    /*
     * retourne la liste complète des identifiants
     */
    public function getUserList() {
        $usersList = array();
        $sql = 'SELECT * FROM User';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $usersList[] = User::feedUser($value);
        }
       return $usersList;
    }

    public function addUser($tab) {
        $e ='';
        $param = ['email' => $tab['email'],
            //encription du password
            'password' => password_hash($tab['password'], PASSWORD_DEFAULT)];
        $req = 'INSERT INTO `User` (email, password) VALUES (:email,:password);';

        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}
        return $e;
    }


    public function getUser($email) {
        $req = 'SELECT * FROM User WHERE email =:email' ;
        $param = ['email' => $email];
        //rempalce les placeholder par leur valeurs, empêchent les injections SQL
            return $this->makeSelect($req, $param);
    }
}





