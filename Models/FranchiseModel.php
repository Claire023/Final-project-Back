<?php


class FranchiseModel extends MainModel {

    /*
     * retourne la liste complète des propositions de Franchises
     */
    public function getFranchiseMessage() {
        $franchiseMessage = array();
        $sql = 'SELECT * FROM Franchise ORDER BY ID DESC';
        $datas = $this->makeSelect($sql);
        foreach($datas as $value){
            $franchiseMessage[] = Franchise::feedFranchise($value);
        }
        return $franchiseMessage;
    }


    //Ajout les infos pour les franchises via formulaire coté front
    public function addFranchise($tab) {
        $e ='';
        $req = 'INSERT INTO Franchise (firstname, lastname, email, phone, city, intake, duration, message, date) VALUES (:firstname,:lastname, :email, :phone, :city, :intake, :duration, :message, :date);';
        $param = ['firstname' => $tab['firstname'],
                    'lastname' => $tab['lastname'] ,
                        'email' => $tab['email'],
                        'phone' => $tab['phone'],
                        'city' => $tab['city'],
                        'intake' => $tab['intake'],
                        'duration' => $tab['duration'],
                        'message' => $tab['message'],
                         'date' => date('Y-m-d H:i:s')];
        try{
            $this->makeStatement($req,$param);
        }catch(PDOexception $e){}

        return $e;
    }




    //Je supprime un prospect en fonction de son ID
    public function deleteFranchise($id){
        $sql = 'DELETE FROM Franchise WHERE ID=:id';
        $param = array('id'=>$id);
        if($this->makeStatement($sql,$param)){
            return true;
        }
        return false;
    }



}

