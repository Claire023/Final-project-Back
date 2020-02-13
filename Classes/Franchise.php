<?php


class Franchise implements JsonSerializable {

    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    private $city;
    private $intake;
    private $duration;
    private $message;
    private $date;


    public function __constructor(){

    }


    public static function feedFranchise(array $fFranchise){

        $franchise = new self();
        //On vérifie l'existence de l'attribut ID
        if(isset($fFranchise['ID'])){
            $franchise->setId($fFranchise['ID']);
        }
        $franchise->setFirstname($fFranchise['firstname']);
        $franchise->setLastname($fFranchise['lastname']);
        $franchise->setEmail($fFranchise['email']);
        $franchise->setPhone($fFranchise['phone']);
        $franchise->setCity($fFranchise['city']);
        $franchise->setIntake($fFranchise['intake']);
        $franchise->setDuration($fFranchise['duration']);
        $franchise->setMessage($fFranchise['message']);
        $franchise->setDate($fFranchise['date']);

        return $franchise;
    }


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getIntake()
    {
        return $this->intake;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $intake
     */
    public function setIntake($intake)
    {
        $this->intake = $intake;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function jsonSerialize() {

        return [
            //a gauche coté database et à droite récupère dans les setters
            'ID' => $this->id,
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'email' => $this->email,
            'phone'=>$this->phone,
            'city'=>$this->city,
            'intake'=>$this->intake,
            'duration'=>$this->duration,
            'message'=>$this->message,
            'date'=>$this->date
        ];
    }













}

