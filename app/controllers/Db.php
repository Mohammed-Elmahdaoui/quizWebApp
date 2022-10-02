<?php

namespace app\controllers;

use \PDO;
use \PDOException;

class Db
{

    private $host;
    private $user;
    private $password;
    private $dbName;

    private $pdo;

    // constructeur
    public function __construct(
        $host = "localhost", 
        $user = "root", 
        $password = "123456", 
        $dbName = "quizapp")
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;

    }

    // distructeur 
    public function __destruct()
    {
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    private function getPDO()
    {
        if ($this->pdo == null) {
            $dsn = "mysql:host=$this->host;dbname=$this->dbName";
            try {
                $this->pdo = new PDO(
                    $dsn,
                    $this->user,
                    $this->password
                );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return $this->pdo;
    }

    /**
     * @param tableName
     * @return table[objet]
     */
    // public function query($statement, $className)
    // {
    //     $stm = $this->pdo->prepare("SELECT * FROM ?;");
    //     $stm->execute([$className]);
    //     return $stm->fetchAll($className);
    // }

    public function query(string $statement, array $parameters, $className, $mode=false)
    {
        echo "<pre>";
        var_dump($statement);
        echo "</pre>";
        echo "<pre>";
        var_dump($parameters);
        echo "</pre>";
        echo "<pre>";
        var_dump($className);
        echo "</pre>";

        $stm = $this->getPDO()->prepare($statement);
        echo "test";
        $stm->execute($parameters);
        echo "testttt";
        if ($mode) {
            return $stm->fetchObject($className);
        } else {
            return $stm->fetchAll($className);
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
