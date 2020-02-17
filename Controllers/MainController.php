<?php

/**
 * @author clairem
 *
 */
Class MainController {

    protected $parameters;// array parametres obtenu en GET par défaut
    protected $data;// array Données obtenu en POST par défaut
    protected $payload;

    public function __construct(){
        //initalisation de mes varialbes en tableau vide
        $this->parameters = array();
        $this->data = array();
        $this->session = array();
        $this->payload = array();
    }



   /**
    * permet initialiser l'entete de la requete http et de renvoyer le corps de la requete en json
    * @param  $data
    * @param number $code
    */
    protected function JsonCall($data, $code = 200){
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: http://localhost:4200");
        header('Vary: Accept-Encoding, Origin');
        header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Accept, Authorization, Content-Type');
        http_response_code($code);
        $myJson = json_encode($data);
        echo $myJson;
    }




    protected function isAuthanticated() {
        try {
            //je donne le coffre et la clé du coffre pour decoder le jwt token , cette cle reste sur mon appli
            $this->payload = JWT::decode($this->data['jwt_token'], SECRET_KEY);
            return true;
            //token valide
        } catch (Exception $e) {
            return false;
        }
    }


//On vérifie si la personne est authentifiée et aussi si notre user est admin
    protected function isAdmin() {
        $result = false;
        //dans l'objet payload on descend et on veux l'objet data et dans data on veux la valeur de l'attribut isAdmin
        if($this->isAuthanticated() && $this->payload->data->isAdmin){
            $result = true;
        }

        return $result;
    }

    /**
     * @return multitype:
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return multitype:
     */
    public function getData()
    {
        return $this->data;
    }



    /**
     * @param multitype: $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param multitype: $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


}
