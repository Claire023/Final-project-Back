<?php

include('ini.php');
include('./Models/MainModel.php');
include('./Models/UserModel.php');
include('./Classes/User.php');



$userModel = new UserModel();
$userModel->getUserList();


$users = $userModel->getUserList();


// foreach($users as $user) {

//   echo($user->getMail());

// }



    header('Content-Type: application/json');
   $myJson = json_encode($users);
    echo $myJson;




 ?>
