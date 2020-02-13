<?php


class FranchiseModel extends MainModel {

    /*
     * retourne la liste complète des propositions de Franchises
     */
    public function getFranchiseMessage() {
        $franchiseMessage = array();
        $sql = 'SELECT * FROM Franchise';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $franchiseMessage[] = Franchise::feedFranchise($value);
        }
        return $franchiseMessage;
    }


    //Ajout les infos pour les franchises via formulaire coté front
    public function addFranchise($tab) {
        $e ='';
        $req = 'INSERT INTO Franchise (firstname, lastname, email, phone, city, intake, duration, message) VALUES (:firstname,:lastname, :email, :phone, :city, :intake, :duration, :message);';
        $param = ['firstname' => $tab['firstname'],
                    'lastname' => $tab['lastname'] ,
                        'email' => $tab['email'],
                        'phone' => $tab['phone'],
                        'city' => $tab['city'],
                        'intake' => $tab['intake'],
                        'duration' => $tab['duration'],
                        'message' => $tab['message']];
        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
    }



}

