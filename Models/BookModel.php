<?php


Class BookModel extends MainModel {



    //Ajout des réservations via formulaire
    public function addContact($tab) {
        $e ='';
        $param = ['person_number' => $tab['person_number'], 'user' => $tab['User'] ,  'date' => $tab['Date'], 'hour' => $tab['Hour']];
        $req = 'INSERT INTO `Contact` (person_number, User, Date, Hour) VALUES (:person_number,:user, :date, :hour);';

        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
    }


//     public function getContact($email) {
//         $req = 'SELECT * FROM Contact WHERE email =:email' ;
//         $param = ['email' => $email];
//         //rempalce les placeholder par leur valeurs, empêchent les injections SQL
//         return $this->makeSelect($req, $param);
//     }


}