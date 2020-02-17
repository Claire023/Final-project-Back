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

        $param = ['email' => $tab['email'],
            //encription du password avec la fonction passwordHash
            //je rajoute 0 car mon user n'est pas admin(admin=1)
            'password' => password_hash($tab['password'], PASSWORD_DEFAULT),
            'isAdmin' => 0];
        $req = 'INSERT INTO `User` (email, password, isAdmin) VALUES (:email,:password, :isAdmin);';
//placeholder pour empecher des injections sql
//je retourne this maskeStatement
       $this->makeStatement($req,$param);

    }




    public function getUser($email) {
        $req = 'SELECT * FROM User WHERE email =:email' ;
        $param = ['email' => $email];
        //rempalce les placeholder par leur valeurs, empêchent les injections SQL
            return $this->makeSelect($req, $param);
    }
}





