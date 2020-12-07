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

    // ide jonnek a queryk
}