<?php

include('ini.php');
include('./Models/MainModel.php');
include ('./Controllers/MainController.php');
include ('./Controllers/UserController.php');
include ('./Controllers/ContactController.php');
include ('./Controllers/ProductController.php');
include ('./Controllers/FranchiseController.php');
include ('./Utilitaires/JWT.php');
include ('./Utilitaires/HttpCode.php');
include ('./Utilitaires/FormValidation.php');


date_default_timezone_set('Europe/Paris');

//Pour récupérer le token coté header
function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        //trim : enleve espaces devant et derriere
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } else if (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);je vusionne les 2 tableaux
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
        //vérifie que ca commence bien par Bearer
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            //récupère la deuxieme partie qui contient le token
            return $matches[1];
        }
    }
    return null;
}

//Recuperation du token
if(getBearerToken() != null) {
    $_POST['jwt_token'] = getBearerToken();
}


// Allow from any origin car en mode dev
//sert a identifier les Cross origins pour établir une communiquation
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//je permet toutes les requetes http normalement
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
}

try {

    //premiere etape pour récupérer le corps d'un requete http.
    //le fichier php input recupere le corps de la requete http et de l'avoir sous forme de string
    //on obtients ensuite un objet $data et a partr de $data on alimente le $post
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

    //On entre nos parametres(GET) et nos données(POST) dans notre controller.
    $controller->setParameters($_GET);
    $controller->setData($_POST);

    //On appelle la méthode correspondant à l'action
     $controller->$action();

} catch (Exception $e){
    http_response_code(404);
    $array['error'] = $e->getMessage();
    //je prepare l'en-tete de ma réponse
    header('Content-Type: application/json');
//     je converti mon objet en json
    $myJson = json_encode($array);
    echo $myJson;

}


 ?>
