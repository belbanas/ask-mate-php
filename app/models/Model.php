<?php

namespace app\models;


use PDO;
use PDOException;

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

    function add_new_user(User $user): void
    {
        $email = $user->getEmail();
        $password_hash = $user->getPasswordHash();

        try {
            $pdo = $this->pdo;
            $sql = 'INSERT INTO registered_user (email, password_hash)
                    VALUES (:email, :password_hash)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email, 'password_hash' => $password_hash]);

        } catch (PDOException $e) {
            echo "Error in SQL: " . $e->getMessage();
        }
    }

    function ask_question(Question $question): void
    {
        $idImage = $question->getIdImage();
        $idRegisteredUser = $question->getIdRegisteredUser();
        $title = $question->getTitle();
        $message = $question->getMessage();
        $voteNumber = $question->getVoteNumber();

        try {
            $pdo = $this->pdo;
            $sql = 'INSERT INTO question (id_image, id_registered_user, title, message, vote_number)
                    VALUES (:idImage, :idRegisteredUser, :title, :message, :voteNumber)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idImage' => $idImage, 'idRegisteredUser' => $idRegisteredUser, 'title' => $title, 'message' => $message, 'voteNumber' => $voteNumber]);

        } catch (PDOException $e) {
            echo "Error in SQL: " . $e->getMessage();
        }
    }

    public function display_a_questions_all_answers(int $question_id)
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM question
                JOIN answer ON question.id = answer.id_question
                WHERE question.id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$question_id]);
        $result = $stmt->fetch();

        var_dump($result);
//        return new Answer($result['id'], $result['id_question'], $result['id_registered_user'], $result['message'],
//            $result['vote_number'], $result['submission_time']);
    }

    public function display_a_question(int $id)
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM question WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        $question = new Question($result['id'], $result['id_image'], $result['id_registered_user'], $result['title'],
            $result['message'], $result['vote_number'], $result['submission_time']);
        return $question;
    }

    public function getUserByEmail(string $email): ?User
    {
        $sql = 'SELECT * FROM registered_user WHERE email=:email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch();
        return new User($result['id'], $result['email'], $result['password_hash'], $result['registration_time']);
    }

    public function deleteAQuestion(int $id): void
    {
        $pdo = $this->pdo;
        $sql = 'DELETE FROM question WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function increaseVote(int $id): void
    {
        $pdo = $this->pdo;
        $sql = 'UPDATE question SET vote_number = vote_number + 1 WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function decreaseVote(int $id): void
    {
        $pdo = $this->pdo;
        $sql = 'UPDATE question SET vote_number = vote_number - 1 WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function saveImage(Image $image)
    {
        $directory = $image->getDirectory();
        $fileName = $image->getFileName();

        $pdo = $this->pdo;
        $sql = 'INSERT INTO image (directory, file_name)
                VALUES (:directory, :fileName)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['directory' => $directory, 'fileName' => $fileName]);
    }

    public function getLastImageId(): int
    {
        $pdo = $this->pdo;
        $sql = 'SELECT id FROM image ORDER BY id DESC LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['id'];
    }

    public function getImages(): array
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM image';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $images = array();
        foreach ($results as $row) {
            $image = new Image($row['id'], $row['directory'], $row['file_name'], $row['upload_time']);
            array_push($images, $image);
        }
        return $images;
    }
}