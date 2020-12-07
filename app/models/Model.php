<?php

namespace app\models;


use PDO;

class Model
{
    private ?PDO $pdo;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = DBConnection::connectToDatabase();
    }


    public function list_questions(){
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM question ORDER BY id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
