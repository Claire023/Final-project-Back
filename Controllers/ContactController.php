<?php


include('./Classes/Contact.php');
include_once('./Models/MainModel.php');
include('./Models/ContactModel.php');


Class ContactController extends MainController {

    public function getContactList(){

        $contactModel = new ContactModel();
        $contacts = $contactModel->getContactList();
        $this->JsonCall($contacts);
    }

}