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


    public function list_questions()
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM question ORDER BY id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $questions = array();
        foreach ($result as $row) {
            $question = new Question($row['id'], $row['id_image'], $row['id_registered_user'], $row['title'],
                $row['message'], $row['vote_number'], $row['submission_time']);
            array_push($questions, $question);
        }
        return $questions;
    }

    function add(User $user): void
    {
        $id = $user->getId();
        $email = $user->getEmail();
        $password_hash = $user->getPasswordHash();
        $registration_time = $user->getRegistrationTime();


        try {
            $pdo = $this->pdo;
            $sql = 'INSERT INTO registered_user (id, email, password_hash, registration_time)
                    VALUES (:email, :password_hash, :registration_time)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id, 'email' => $email, 'password_hash' => $password_hash, 'registration_time' => $registration_time]);

        } catch (PDOException $e) {
            echo "Error in SQL: " . $e->getMessage();
        }
    }

}
