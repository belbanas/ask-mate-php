<?php


namespace app\models;


use PDO;
use PDOException;

/**
 * Class DbConnection
 * @package app\controllers
 */
class DBConnection
{
    /**
     * @return PDO|null
     */
    public static function connectToDatabase(): ?PDO
    {
        $path = 'db_config.json';
        $str = file_get_contents($path);
        $params = json_decode($str, true);

        $servername = $params['servername'];
        $username = $params['username'];
        $password = $params['password'];
        $dbname = $params['dbname'];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "\n";
        }
        return null;
    }
}
