<?php


include('./Classes/User.php');
include('./Models/UserModel.php');


Class UserController extends MainController {


    public function getUserList(){

        if($this->isAuthanticated()) {
        $userModel = new UserModel();
        $users = $userModel->getUserList();
        //je converti en json
        $this->JsonCall($users);

        }
    }


    public function addUser(){
        if(FormValidation::isValidEmail($this->data['email']) && FormValidation::isAlphaNumeric($this->data['password'])) {
                try {
                    $userModel = new UserModel();
                    $userModel->addUser($this->data);
                    $this->JsonCall($this->data);

                } catch (Exception $e){

                    if($e->getCode() == 23000) {
                        $this->JsonCall(Array(
                            'message' => "Cet email est déjà utilisé"

                        ),HttpCode::BAD_REQUEST);

                    } else {
                        $this->JsonCall(Array(
                            'message' => $e->getMessage()

                        ),HttpCode::INTERNAL_SERVER_ERROR);
                    }
                }

            } else {
                $this->JsonCall(Array(
                    'message' => 'Erreur'
                ), HttpCode::UNAUTHORIZED);

            }
    }


    public function connexionUser(){

        if (isset($this->data['email']) && isset($this->data['password'])) {
            try {

                $userModel = new UserModel();
                $rep = $userModel->getUser($this->data['email']);
                //je vais chercher ma clé email pour m'authentifier

                if (sizeof($rep) > 1) {
                    //Si Plus d'une entrée
                    throw new Exception("Problème rencontré lors de l'identification, veuillez rééessayer plus tard");
                }

                if (sizeof($rep) == 0) {
                    throw new Exception("Identifiant de connexion ou mot de passe incorrect");
                }

                $user = User::feedUser($rep[0]);
                //On compare les mdp avec la fonction password_verify
                if (password_verify($this->data['password'], $user->getPassword())) {


                    //CREATION TOKEN pour s'authentifier
                    $token = array(
                        //prend les parametre de ini.php
                        "val" => VALIDATION_START,
                        "dcr" => DATE_CREATION,
                        "exp" => EXPIRATION_DATE,
                        //payload du token : contient les infos du user qui permettront lors d'une prochaine requete d'identifier le user en question
                        //dedans tout est encrypté
                        "data" => array(
                            "email" => $user->getMail(),
                            "password" => $user->getPassword(),
                            "isAdmin" => $user->getIsAdmin()
                        )
                    );

                     //Encodage token car j'ai juste un objet et je dois le transformer en jwt token
                    $jwt = JWT::encode($token, SECRET_KEY);

                    $this->JsonCall(Array(
                        'message' => "Accès autorisé",
                        //je retourne mon token
                        'jwt' => $jwt,
                        'exp' => EXPIRATION_DATE, //renvoi date expiration en secondes
                        //ajout admin
                        'isAdmin' => $user->getIsAdmin()
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


