<?php

class FormValidation {


    /**
     * Verifie si un string est un mail
     * @param  [string]  $mail string a tester
     * @return boolean
     */
    static public function isValidEmail($mail){// /!\ POUR TESTER LES EMAIL VOIR LA DOC DE filter_var() /!\
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
            //premier argument : ce que je veux tester , 2eme : restriction que l'o veut tester sur le string(inclue la regex)
            return true;
        }
        return false;

    }


    /**
     * Verifie si un string est composé uniquement de caracteres numeriques
     * @param  [string]  $string [description]
     * @return boolean
     */
    static public function isNumeric($num){
        //On verifie si le string est vide
        return !empty($num) && is_numeric($num);
        //retourne true ou false dans les 2 cas
    }


    /**
     * Verifie si un string est composé uniquement de caracteres
     * @param  [string]  $string [description]
     * @return boolean
     */
    static public function isString($string){
        //On verifie si le string est vide et que l'input contient bien un string
        return  is_string($string);
        //retourne true ou false dans les 2 cas
    }



    static public function isValidPassword($string){
        //On verifie si le string est vide
        return !empty($string) && preg_match('#^(?=\\D*\\d)(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z]).{8,30}$#', $string);
        //Minimum 8 characters, at least one letter, one number, one maj , one spécial char
    }



    /**
     * Verifie si un string est composé uniquement de caracteres alphanumeriques, avec des tirets
     * @param  [string]  $string [description]
     * @param  [int]  $min    taille minimale autorise du string
     * @param  [int]  $max    taille maximale autorise du string
     * @return boolean
     */
    static public function isAlphaNumeric($string){
        //On verifie si le string est vide
        return !empty($string) && preg_match('#^[A-Za-z0-9_-]{6,}$#', $string);
        //Minimum six characters, at least one letter, one number
    }

    /**
     * Verifie si le string est supérieur ou égal à un nombre donné
     * @param  string  $string string a tester
     * @param  int  $min    borne MIN
     * @return boolean
     */
    static public function isSuperiorOrEqualTo($string, $min){
        if(strlen($string)<$min){
            return false;
        }
        return true;
    }



    /**
     * Verifie si le string est inférieur ou égal à un nombre donné
     * @return boolean
     */
    static public function isInferiorOrEqualTo($string, $max){
        if($max == 'infinite'){
            return true;
        }
        if(strlen($string)>$max){
            return false;
        }
        return true;
    }



}

