<?php

namespace app\modules;

use app\controllers\Db;


class Competence
{

    /** @var int */
    private int $codeCompetence;

    /** @var string */
    private string $label;

    /**
     * Default constructor
     */
    public function __construct()
    {
        // ...
    }


    /**
     * Default constructor
     */
    public static function getExamens($idCompetence)
    {
        $db = new Db();

        $stm = "SELECT * FROM `examen` WHERE  `idCompetence` = ?";

        return $db->query($stm, [$idCompetence], 'app\modules\Examen');
    }


}
