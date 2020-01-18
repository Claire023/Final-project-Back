<?php



class Contact implements JsonSerializable  {


        private $id;
        private $email;
        private $nom;
        private $sujet;
        private $message;


        public function __constructor(){

        }


        public static function feedContact(array $fContact){

            $contact = new self();
            //On vérifie l'existence de l'attribut ID
            if(isset($fContact['ID'])){
                $contact->setId($fContact['ID']);
            }
            $contact->setEmail($fContact['email']);
            $contact->setNom($fContact['nom']);
            $contact->setSujet($fContact['sujet']);
            $contact->setMessage($fContact['message']);

            return $contact;
        }


        public function toString(){
            return $this->email;
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
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @return mixed
         */
        public function getNom()
        {
            return $this->nom;
        }

        /**
         * @return mixed
         */
        public function getSujet()
        {
            return $this->sujet;
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
         * @param mixed $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @param mixed $nom
         */
        public function setNom($nom)
        {
            $this->nom = $nom;
        }

        /**
         * @param mixed $sujet
         */
        public function setSujet($sujet)
        {
            $this->sujet = $sujet;
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
                'ID' => $this->id,
                'email' => $this->email,
                'nom' => $this->nom,
                'sujet' => $this->sujet,
                'message' => $this->message,
            ];
        }

 }

