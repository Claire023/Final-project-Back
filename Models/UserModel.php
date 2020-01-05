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
}