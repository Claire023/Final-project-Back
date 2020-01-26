<?php


define('DS', DIRECTORY_SEPARATOR); //Raccourci séparation folder
define('CONTROLLERS_PATH', 'Controllers');


//Parametres de connexion à la BDD
define('DB_HOST', 'localhost');
define('DB_NAME', 'maria-cantina');
define('DB_USER', 'root');
define('DB_PASS','root');

//Constantes pour jwt (token)
define('SECRET_KEY','secret_key');
define('DATE_CREATION',time());
define('VALIDATION_START',DATE_CREATION);
define('EXPIRATION_DATE', VALIDATION_START + 3000); //temps de validité du token
