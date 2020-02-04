<?php

/**
 * @author clairem
 *
 */
Class MainController {

    protected $parameters;// array parametres obtenu en GET par défaut
    protected $data;// array Données obtenu en POST par défaut
    protected $session;// array Données obtenu en SESSION par défaut
    protected $payload;

    public function __construct(){
        $this->parameters = array();
        $this->data = array();
        $this->session = array();
        $this->payload = array();
    }


    protected function JsonCall($data, $code = 200){
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        http_response_code($code);
        $myJson = json_encode($data);
        echo $myJson;

    }

    protected function isAuthanticated() {
        try {
            $this->payload = JWT::decode($this->data['jwt_token'], SECRET_KEY);
            return true;
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
     * @return multitype:
     */
    public function getSession()
    {
        return $this->session;
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

    /**
     * @param multitype: $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

}
