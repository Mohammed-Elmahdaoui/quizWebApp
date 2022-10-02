<?php

namespace app\modules;

use app\controllers\Db;


class User
{

    public static function login(string $username, string $password, string $type)
    {
        $db = new Db();

        $stm = "SELECT * FROM $type WHERE username=? AND password=?;";

        $user = $db->query(
            $stm, 
            [$username, $password], 
            get_called_class(), 
            true
        );


        return $user;
    }


    



}