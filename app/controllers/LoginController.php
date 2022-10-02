<?php

namespace app\controllers;

use app\modules\Formateur;
use app\modules\Stagiaire;

class LoginController
{

    
    // public function login
    public static function login(string $username, string $password, string $type)
    {
        if ($type == "formateur") {
            $user = Formateur::login($username, $password, $type);

        } elseif($type == "stagiaire") {
            $user = Stagiaire::login($username, $password, $type);
        }
        return $user;
    }
}
