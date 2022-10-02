<?php

namespace app\modules;

use app\controllers\Db;


class Filiere
{

    /** @var int */
    private int $idFiliere;

    /** @var string */
    private string $label;

    /**
     * Default constructor
     */
    public function __construct()
    {
        // ...
    }

    public function getModules()
    {
        $db = new Db();

        $stm = "SELECT * from filiere fl 
                where fl.id in ( 
                    SELECT ff.idFiliere 
                    FROM formateur_filiere ff 
                    WHERE ff.idFormateur = ?
                )";
        return $db->query($stm, [$this->idFormateur], 'app\modules\Filiere');
    }



}
