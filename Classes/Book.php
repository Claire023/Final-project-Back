<?php


class Book implements  JsonSerializable {



    private $id;
    private $person_number;
    private $user;
    private $date;
    private $hour;


    public function __constructor(){

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
    public function getPerson_number()
    {
        return $this->person_number;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
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
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $person_number
     */
    public function setPerson_number($person_number)
    {
        $this->person_number = $person_number;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $hour
     */
    public function setHour($hour)
    {
        $this->hour = $hour;
    }


    public function jsonSerialize() {

        return [
            //a gauche coté database et à droite récupère dans les setters
            'ID' => $this->id,
            'person_number' => $this->person_number,
            'User' => $this->user,
            'Date' => $this->date,
            'Hour' => $this->hour,
        ];
    }

}



