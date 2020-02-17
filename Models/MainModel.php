<?php

class MainModel{
    private static $pdo = NULL;//Notre objet PDO permettant la connexion a notre base

    //La fonction __construct nous retourne notre objet PDO si il existe deja , sinon , il nous le crée
    public function __construct(){
        if(self::$pdo == NULL){ //si n'existe pas : on crée
            //Pour changer les identifiants en prod je vais le fichier ini.php
            self::$pdo = new PDO ('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }


    /**
     * Permet de créer et executer les requetes
     * @param  $sql
     * @param array $params je spécifie mes paramètre (mes variables)
     * permet de gérer plusieurs requetes , plusieurs types de requetes et des parametre en nombre différents
     * @return boolean|PDOStatement
     */
    protected function makeStatement($sql, $params = array())
    {
        if(count($params) == 0)
        //si je n'ai pas de paramètres je rentre dans ce if et j'execute directement la query
        {
            $statement = self::$pdo->query($sql);
        }
        else
        //Si on a des parametres , on fait un d'abord un prepare
        {
            if(($statement = self::$pdo->prepare($sql)) !== false)
            {
                foreach ($params as $placeholder => $value)
                {
                    //Dans le foreach je récupere ma valeur associée au parametre et je vérifie le type de mes parametres dans un switch
                    //pour chaque param j'itere dans mon switch
                    switch(gettype($value))
                    {
                        case "integer":
                            //si integer, je vais chercher dans PDO PARAM_INT
                            $type = PDO::PARAM_INT;
                            break;

                        case "boolean":
                            $type = PDO::PARAM_BOOL;
                            break;

                        case "NULL":
                            $type = PDO::PARAM_NULL;
                            break;

                        default:
                            $type = PDO::PARAM_STR;
                    }
                    if($statement->bindValue($placeholder, $value, $type) === false){
                        //permet de remplacer mes variables par leur valeurs, si pb je retourne false et j'arrete le traitement
                        return false;
                    }
                }
                if(!$statement->execute())
                //maintenant je peux execute ma query , si pb je retourne false
                {
                    return false;
                }
            }
        }
        //tout s'est bien passé je retourne le statement
        return $statement;
    }

    /**
     * @param string $sql Your SELECT query
     * @param array $params An associative array with form : 'placeholder' => $value
     * @param int $fetchStyle
     * @param mixed $fetchArg
     * @return array|bool An array containing all result lines or false if an error occurred
     * @throws PDOException (Depending on PDO Config)
     */
    //Permet les requetes de type SELECT
    protected function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL)
    //fetchstyle : on precise a la bdd sous quel format on veux recevoir les données la en l'occurrence un tableau associtatif
    {
        $statement = $this->makeStatement($sql, $params);

        if($statement === false)
        {
            return false;
        }

        $data = is_null($fetchArg) ? $statement->fetchAll($fetchStyle) : $statement->fetchAll($fetchStyle, $fetchArg);
        //on récupere les données en precisant les arguments et on retourne les valeurs.
        $statement->closeCursor();

        return $data;
    }
}