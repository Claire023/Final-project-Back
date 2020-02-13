<?php


include('./Classes/Contact.php');
include('./Models/ContactModel.php');


Class ContactController extends MainController {

//Obtenir la liste des contacts et messages issu du formulaire client
    public function getContactList(){

        $contactModel = new ContactModel();
        $contacts = $contactModel->getContactList();
        $this->JsonCall($contacts);
    }


    public function addContact(){

        $contactModel = new ContactModel();
        $contactModel->addContact($this->data);

        $this->JsonCall($this->data);
    }


    public function deleteContact(){
            $contactModel = new ContactModel();
            if($contactModel->deleteContact($this->parameters['ID'])){
                header('Location:index.php?controller=contact&action=getContactList');
            }
            else{
                echo "error";
            }

        }

}