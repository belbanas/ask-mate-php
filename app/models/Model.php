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
        $id = $user->getId();
        $email = $user->getEmail();
        $password_hash = $user->getPasswordHash();
        $registration_time = $user->getRegistrationTime();


        try {
            $pdo = $this->pdo;
            $sql = 'INSERT INTO registered_user (email, password_hash, registration_time)
                    VALUES (:email, :password_hash, :registration_time)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email, 'password_hash' => $password_hash, 'registration_time' => $registration_time]);

        } catch (PDOException $e) {
            echo "Error in SQL: " . $e->getMessage();
        }
    }

    function ask_question(Question $question): void
    {
        $id = $question->getId();
        $idImage = $question->getIdImage();
        $idRegisteredUser = $question->getIdRegisteredUser();
        $title = $question->getTitle();
        $message = $question->getMessage();
        $voteNumber = $question->getVoteNumber();
        $submissionTime = $question->getSubmissionTime();

        try {
            $pdo = $this->pdo;
            $sql = 'INSERT INTO question (id_image, id_registered_user, title, message, vote_number, submission_time)
                    VALUES (:idImage, :idRegisteredUser, :title, :message, :voteNumber, :submissionTime)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idImage' => $idImage, 'idRegisteredUser' => $idRegisteredUser, 'title' => $title, 'message' => $message, 'voteNumber' => $voteNumber, 'submissionTime' => $submissionTime]);

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
        $results = $stmt->fetchAll();
        $answers = array();
        foreach ($results as $result) {
            $answer = new Answer($result['id'], $result['id_question'], $result['id_registered_user'], $result['message'],
                $result['vote_number'], $result['submission_time']);
            array_push($answers, $answer);
        }
        return $answers;
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

    public function deleteAQuestion(int $id): void
    {
        $pdo = $this->pdo;
        $sql = 'DELETE FROM question WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function deleteAnAnswer(int $id): void
    {
        $pdo = $this->pdo;
        $sql = 'DELETE FROM answer WHERE id=:id';
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

    public function increaseAnswerVote(int $id): void
    {
        $pdo = $this->pdo;
        $sql = 'UPDATE answer SET vote_number = vote_number + 1 WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function decreaseAnswerVote(int $id): void
    {
        $pdo = $this->pdo;
        $sql = 'UPDATE answer SET vote_number = vote_number - 1 WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function getAnswerById(int $id): Answer
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM answer WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return new Answer ($result['id'], $result['id_question'], $result['id_registered_user'], $result['message'], $result['vote_number'], $result['submission_time']);
    }

}


