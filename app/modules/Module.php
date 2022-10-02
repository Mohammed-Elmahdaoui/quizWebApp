<?php

namespace app\modules;

use app\controllers\Db;


class Module
{

    /** @var int */
    private int $idModule;

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
    public static function getCompetences($idModule)
    {
        $db = new Db();

        $stm = "SELECT * FROM `competence` WHERE `idModule` = ? ";

        return $db->query($stm, [$idModule], 'app\modules\Competence');
    }
}
