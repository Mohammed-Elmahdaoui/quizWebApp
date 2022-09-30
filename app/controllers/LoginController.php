<?php

namespace app\controllers;

use app\modules;

class LoginController
{

    private Db $pdo;

    public function __construct()
    {
        $this->pdo = new Db();
    }
    
    // public function store(string $email, string $password, string $type, Db $db)
    public function stor(string $email, string $password, string $type)
    {
        $userObj = null;
        if ($type == "formateur") {
            $userObj = modules\Formateur::login($this->pdo->connect(), $email, $password);
        } else {

            $userObj = modules\Stagiaire::login($this->pdo->connect(), $email, $password);
        }
        // header("location:MenuPrincipale.php");
        //print_r("Welcome Formateur ,".$userObj->getNom());
        $_SESSION['user'] = serialize($userObj);
        header("location:../menu");
    }
}
