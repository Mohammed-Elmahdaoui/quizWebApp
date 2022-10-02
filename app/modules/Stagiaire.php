<?php

namespace app\modules;

class Stagiaire extends User
{

    /** @var int */
    private int $idStagiaire;

    private  $userName;

    private  $password;

    /** @var string */
    private string $nom;

    /** @var string */
    private string $prenom;

    /** @var string */
    private string $username;

    /** @var string */
    private string $pasword;

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
    // public function login()
    // {
    //     // TODO implement here
    // }

    /**
     * 
     */
    public function passerExamen()
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
     * Get the value of idStagiaire
     */ 
    public function getId()
    {
        return $this->idStagiaire;
    }
}
