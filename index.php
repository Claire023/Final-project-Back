<?php

include('ini.php');
include('./Models/MainModel.php');
include ('./Controllers/MainController.php');
include ('./Controllers/UserController.php');
include ('./Controllers/ContactController.php');
include ('./Controllers/BookController.php');
include ('./Utilitaires/JWT.php');



date_default_timezone_set('Europe/Paris');

//Pour récupérer le token coté header

function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        //trim : enelve espaces devant et derriere
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } else if (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}
/**
 * get access token from header
 * */
function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        //vérifie que ca comment bien par Bearer
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            //récupère la deuxiere partie
            return $matches[1];
        }
    }
    return null;
}

//Recuperation du token
$_POST['jwt_token'] = getBearerToken();

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
}


try {


    //premiere etape pour récupérer le corps d'un requete http.
    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data)) {
        foreach ($data as $key => $value){
            $_POST[$key]= $value;
        }
    }


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
