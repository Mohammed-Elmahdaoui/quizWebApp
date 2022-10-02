<?php

namespace app\modules;

use app\controllers\Db;


class Assurer
{

    /**
     * Default constructor
     */
    public static function getModules($idFormateur, $idFiliere)
    {
        $db = new Db();

        $stm = "SELECT * from MODULE md WHERE md.idFiliere = ? AND md.id in (SELECT ms.idModule from ModuleAssurer ms WHERE ms.idFormateur = ?)";

        return $db->query($stm, [$idFiliere, $idFormateur], 'app\modules\Module');
    }

}
