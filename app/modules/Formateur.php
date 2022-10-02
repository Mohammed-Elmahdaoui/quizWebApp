<?php

namespace app\modules;

use app\controllers\Db;

class Formateur extends User
{

    /** @var int */
    private int $idFormateur;

    /** @var string */
    private string $nom;

    /** @var string */
    private string $prenom;

    /** @var string */
    private string $username;

    /** @var string */
    private string $password;
    
    /**
     * Default constructor
     */
    public function __construct()
    {
        // ...
    }
    
    /**
     * 
     */
    // public static function login($username, $password)
    // {
    //     // TODO implement here
    // }

    /**
     * 
     */
    public function getFilieres()
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
    
    /**
     * 
     */
    public function AjouterExamen()
    {
        // TODO implement here
    }

    /**
     * 
     */
    public function modifierExamen()
    {
        // TODO implement here
    }

    /**
     * 
     */
    public function supprimerExamen()
    {
        // TODO implement here
    }

    /**
     * 
     */
    public function consulter()
    {
        // TODO implement here
    }



    /**
     * Get the value of idFormateur
     */ 
    public function getId()
    {
        return $this->idFormateur;
    }
}
