<?php

include('./Classes/Book.php');



Class BookController extends MainController {


public function addBooking() {

    //récupère le token from index.php
    if($this->isAuthanticated()){
        print_r($this->payload);
    } else {
        $this->JsonCall(Array(
            'message' => "Echec de l'authentification"
        ), 401);
    }


}



}
