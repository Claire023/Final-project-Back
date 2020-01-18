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



    public function getContact($email) {
        $req = 'SELECT * FROM Contact WHERE email =:email' ;
        $param = ['email' => $email];
        //rempalce les placeholder par leur valeurs, empêchent les injections SQL
        return $this->makeSelect($req, $param);
    }


}