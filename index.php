<?php

include('ini.php');
include ('./Controllers/MainController.php');
include ('./Controllers/UserController.php');


try {

    //On écrase les paramètres par défaut si on a des informations en GET
    $params = $_GET;

    //On génère le nom du controller à appeler en fonction des paramètres
    $controllerName = ucfirst($params['controller']).'Controller';

    //On définit l'action en fonction des paramètres
    $action = $params['action'];
    if(file_exists(CONTROLLERS_PATH . DS . $controllerName . '.php')){
    //existance du fichier controller, et si il existe on instancie notre controller
        $controller = new $controllerName;
    } else {
        throw new Exception("ce controller n'existe pas");
    }


    //On entre nos parametres(GET) et nos données(POST) dans notre controleur.
    $controller->setParameters($_GET);
    $controller->setData($_POST);

    //On appelle la méthode correspondant à l'action
     $controller->$action();

} catch (Exception $e){
    http_response_code(404);
    $array['error'] = $e->getMessage();
    header('Content-Type: application/json');
    $myJson = json_encode($array);
    echo $myJson;

}


 ?>
