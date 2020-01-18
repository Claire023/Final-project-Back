<?php


include('./Classes/User.php');
include('./Models/MainModel.php');
include('./Models/UserModel.php');



Class UserController extends MainController {


    public function getUserList(){

        $userModel = new UserModel();
        $users = $userModel->getUserList();
        $this->JsonCall($users);
    }


    public function addUser(){

        //$userToAdd = User::feedUser($this->data);
        $userModel = new UserModel();
        $userModel->addUser($this->data);


        $this->JsonCall($this->data);
    }


    public function connexionUser(){
        if (isset($this->data['email']) && isset($this->data['password'])) {
            try {

                $userModel = new UserModel();
                $rep = $userModel->getUser($this->data['email']);

                if (sizeof($rep) > 1) {
                    //Si Plus d'une entrée
                    throw new Exception("Problème rencontré lors de l'identification, veuillez rééessayer plus tard");
                }

                if (sizeof($rep) == 0) {
                    throw new Exception("Identifiant de connexion ou mot de passe incorrect");
                }
                $user = User::feedUser($rep[0]);
                if (password_verify($this->data['password'], $user->getPassword())) {

                    //CREATION TOKEN
                    $token = array(
                        //prend les parametre de ini.php
                        "val" => VALIDATION_START,
                        "dcr" => DATE_CREATION,
                        "exp" => EXPIRATION_DATE,
                        "data" => array(
                            "email" => $user->getMail(),
                            "password" => $user->getPassword()
                        )
                    );



                     //Encodage token
                    $jwt = JWT::encode($token, SECRET_KEY);

                    $this->JsonCall(Array(
                        'message' => "Accès autorisé",
                        'jwt' => $jwt,
                        'exp' => EXPIRATION_DATE //renvoi date expiration en secondes
                    ));



                } else {
                    throw new Exception("Identifiant de connexion ou mot de passe incorrect");
                }

            } catch (Exception $e) {
                $this->JsonCall(Array(
                    'message' => $e->getMessage()
                ));
            }
        } else {
            $this->JsonCall(Array(
                'message' => 'veuiller entrer votre mail et votre mot de passe'
            ), 401);
        }
    }


}


