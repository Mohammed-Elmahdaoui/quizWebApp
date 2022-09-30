<?php

namespace app\controllers;

use \PDO ;
use \PDOException ;

class Db
{

    private $host = "localhost";
    private $user = "root";
    private $password = "123456";
    private $dbName = "quizapp";

    public $pdo;

    // constructeur
    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbName";
        try {
            $this->pdo = new PDO(
                $dsn,
                $this->user,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // distructeur 
    public function __destruct()
    {
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }


    /**
     * @param tableName
     * @return table[objet]
     */
    public function query($tableName)
    {
        $stm = $this->pdo->prepare("SELECT * FROM ?;");
        $stm->execute([$tableName]);
        return $stm->fetchAll();
    }

    public function prepare($statement, $parameters, $mode=false)
    {
        $stm = $this->pdo->prepare($statement);
        $stm->execute($parameters);
        if($mode){
            return $stm->fetch();
        }else{
            return $stm->fetchAll();
        }
    }





    

    public function queryAllModule($codeFiliere)
    {
        $stm = $this->pdo->prepare("SELECT module.codeModule, module.label from module 
        inner join assurer on module.codeModule = assurer.codeModule
        inner join groupe on groupe.codeGroupe = assurer.codeGroupe
        inner join filiere on filiere.codeFiliere = groupe.codeGroupe
        where filiere.codeFiliere = ?
        ;");
        $stm->execute([$codeFiliere]);
        return $stm->fetchAll();
    }

    public function queryAllCompetence($codeModule)
    {
        $stm = $this->pdo->prepare("SELECT * from competence
        where codeModule = ?
        ;");
        $stm->execute([$codeModule]);
        return $stm->fetchAll();
    }










}