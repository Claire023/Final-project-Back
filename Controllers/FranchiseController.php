<?php


include('./Classes/Franchise.php');
include('./Models/FranchiseModel.php');



class FranchiseController extends MainController {

    //Obtenir la liste des messages pour la franchise
    public function getFranchiseList(){

        $franchiseModel = new FranchiseModel();
        $franchise = $franchiseModel->getFranchiseMessage();
        $this->JsonCall($franchise);
    }



    //injecte les données du formulaire
    public function addFranchise(){
        $franchiseModel = new FranchiseModel();
        $franchiseModel->addFranchise($this->data);
        $this->JsonCall($this->data);
    }



}

