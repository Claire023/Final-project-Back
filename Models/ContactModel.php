<?php

Class ContactModel extends MainModel {


    /*
     * retourne la liste complète des contacts et messages
     */
    public function getContactList() {
        $contactList = array();
        $sql = 'SELECT * FROM Contact ORDER BY ID DESC';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $contactList[] = Contact::feedContact($value);
        }
        return $contactList;
    }


    public function getContact($email) {
        $req = 'SELECT * FROM Contact WHERE email =:email' ;
        $param = ['email' => $email];
        //remplace les placeholder par leur valeurs, empêchent les injections SQL
        return $this->makeSelect($req, $param);
    }

    //Ajout des contacts via formulaire de contact
    public function addContact($tab) {
        $e ='';
        $param = ['email' => $tab['email'], 'nom' => $tab['nom'] ,  'sujet' => $tab['sujet'], 'message' => $tab['message'],'date' => date('Y-m-d H:i:s') ];
        $req = 'INSERT INTO `Contact` (email, nom, sujet, message, date) VALUES (:email,:nom, :sujet, :message, :date);';
        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
    }


    //Je supprime un contact en fonction de son ID
    public function deleteContact($id){
        $sql = 'DELETE FROM Contact WHERE ID=:id';
        $param = array('id'=>$id);
        if($this->makeStatement($sql,$param)){
            return true;
        }
        return false;
    }


}