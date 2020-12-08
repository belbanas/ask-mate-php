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

    public function display_a_question(int $id)
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM question WHERE ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        $question = new Question($result['id'], $result['id_image'], $result['id_registered_user'], $result['title'],
        $result['message'], $result['vote_number'], $result['submission_time']);
        return $question;
    }

}

$con = new Model();

//$user = new User(12,'wad@wad.hu','asdf', '2020-10-10 10:10:10');
//$con->add_new_user($user);

//$question = new Question(100,1,10,'Szevasz,','hello',2,'2020-10-10 12:12:12');
//$con->ask_question($question);

echo '-----------<br>';
$stuff = $con->display_a_question(2);
var_dump($stuff);

echo $stuff->getId();
echo $stuff->getMessage();
echo '-----------<br>';
