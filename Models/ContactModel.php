<?php

Class ContactModel extends MainModel {


    /*
     * retourne la liste complète des contacts et messages
     */
    public function getContactList() {
        $contactList = array();
        $sql = 'SELECT * FROM Contact';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $contactList[] = Contact::feedContact($value);
        }
        return $contactList;
    }



    //Ajout des contacts via formulaire de contact
    public function addContact($tab) {
        $e ='';
        $param = ['email' => $tab['email'], 'nom' => $tab['nom'] ,  'sujet' => $tab['sujet'], 'message' => $tab['message']];
        $req = 'INSERT INTO `Contact` (email, nom, sujet, message) VALUES (:email,:nom, :sujet, :message);';

        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
    }


    public function getContact($email) {
        $req = 'SELECT * FROM Contact WHERE email =:email' ;
        $param = ['email' => $email];
        //remplace les placeholder par leur valeurs, empêchent les injections SQL
        return $this->makeSelect($req, $param);
    }


}