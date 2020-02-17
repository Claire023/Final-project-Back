<?php


include('./Classes/Franchise.php');
include('./Models/FranchiseModel.php');



class FranchiseController extends MainController {

    // Obtenir la liste des messages pour la franchise
    public function getFranchiseList() {
        $franchiseModel = new FranchiseModel();
        $franchise = $franchiseModel->getFranchiseMessage();
        $this->JsonCall($franchise);
    }

        // injecte les données du formulaire
    public function addFranchise(){
        if (
            is_string($this->data['firstname']) && is_string($this->data['lastname']) &&
             FormValidation::isValidEmail($this->data['email']) && is_string($this->data['phone']) &&
            FormValidation::isString($this->data['city']) && FormValidation::isNumeric($this->data['intake']) &&
            FormValidation::isNumeric($this->data['duration']) && is_string($this->data['message'])) {
            $franchiseModel = new FranchiseModel();
            $franchiseModel->addFranchise($this->data);
            $this->JsonCall($this->data);
        } else {

            $this->JsonCall(Array(
                'message' => 'Erreur'
            ), HttpCode::UNAUTHORIZED);
        }
    }


    public function deleteFranchise(){
        $franchiseModel = new FranchiseModel();
        if ($franchiseModel->deleteFranchise($this->parameters['ID'])) {
            header('Location:index.php?controller=franchise&action=getFranchiseList');
        } else {
            echo "error";
        }
    }
}

