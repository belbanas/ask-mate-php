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

    public function display_a_questions_all_answers(int $question_id): Answer
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM question
                JOIN answer ON question.id = answer.id_question
                WHERE question.id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$question_id]);
        $result = $stmt->fetch();

//        var_dump($result);
        return new Answer($result['id'], $result['id_question'], $result['id_registered_user'], $result['message'],
            $result['vote_number'], $result['submission_time']);
    }

    public function display_a_question(int $id): Question
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM question WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id'=>$id]);
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
        $stmt->execute(['id'=>$id]);
    }




    public function display_all_questions_by_tags_name(string $tag_name)
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM question
                  JOIN rel_question_tag ON question.id = rel_question_tag.id_question
                  JOIN tag ON rel_question_tag.id_tag = tag.id
                  WHERE tag.name = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tag_name]);
        $result = $stmt->fetchAll();
        $questions = array();
        foreach ($result as $row) {
            $question = new Question($row['id'], $row['id_image'], $row['id_registered_user'], $row['title'],
                $row['message'], $row['vote_number'], $row['submission_time']);
            array_push($questions, $question);
        }
        return $questions;
    }

}


$con = new Model();
$t = $con->display_all_questions_by_tags_name('test');
$g = $t[0];
echo $g->getMessage();

//$con->deleteAQuestion(2);

//$user = new User(12,'wad@wad.hu','asdf', '2020-10-10 10:10:10');
//$con->add_new_user($user);

//$question = new Question(100,1,10,'Szevasz,','hello',2,'2020-10-10 12:12:12');
//$con->ask_question($question);

//echo '-----------<br>';
//$stuff = $con->display_a_question(2);
//var_dump($stuff);

//echo $stuff->getId();
//echo $stuff->getMessage();
//echo '-----------<br>';

// error messag when add an answer: Cannot add or update a child row: a foreign key constraint fails (`ask_mate_again`.`answer`, CONSTRAINT `fk_question_on_answer` FOREIGN KEY (`id_question`) REFERENCES `question` (`id`))
//var_dump($con->display_a_question(2));
//var_dump($con->display_a_questions_all_answers(2));
