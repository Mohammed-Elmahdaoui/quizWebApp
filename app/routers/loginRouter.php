<?php

session_start();

require_once "../vendor/autoload.php";

use \app\controllers\LoginController;
use \app\modules\Formateur;
use \app\modules;



if (isset(
    $_POST["email"],
    $_POST["password"],
    $_POST["type"]
)) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["type"];
    // $db = new Db();
    $loginController = new LoginController();
    // $loginController->store($email, $password,$type , $db);
    $loginController->stor($email, $password, $type);
}
