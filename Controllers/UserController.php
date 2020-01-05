<?php

include('./Classes/User.php');
include('./Models/MainModel.php');
include('./Models/UserModel.php');



Class UserController extends MainController {


    public function getUserList(){

        $userModel = new UserModel();
        $users = $userModel->getUserList();
        $this->JsonCall($users);
    }


}