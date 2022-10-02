<?php

session_start();

require_once "../vendor/autoload.php";

use \app\controllers\LoginController;
use \app\modules;

if (isset(
    $_POST["username"],
    $_POST["password"],
    $_POST["type"]
)) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $type = $_POST["type"];

    $user = LoginController::login($username, $password, $type);

    if($user){
        $_SESSION["user"] = serialize($user);

        if($user instanceof modules\Formateur){
            header("Location: ../views/dashboardFormateur.php");
        }else{
            header("Location: ../views/dashboardStagiaire.php");
        }
    }else{
        header("Location: ../views/login.php?error=true");
    }
}
