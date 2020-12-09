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


    public function display_all_tags()
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM tag';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $tags = array();
        foreach ($result as $item) {
            array_push($tags, $item);
        }
        return $tags;
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


    public function check_if_tag_exists_on_a_question(int $tag_id, int $question_id)
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM rel_question_tag 
                WHERE id_question = ? AND id_tag = ?
                LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$question_id, $tag_id]);
        return $stmt->fetch() == null ? false : true;
    }


    function add_tag_to_question(Tag $tag, Question $question): void
    {
        $t_id = $tag->getId();
        $tag_name = $tag->getName();

        $q_id = $question->getId();
        $idImage = $question->getIdImage();
        $idRegisteredUser = $question->getIdRegisteredUser();
        $title = $question->getTitle();
        $message = $question->getMessage();
        $voteNumber = $question->getVoteNumber();
        $submissionTime = $question->getSubmissionTime();

        $if_not_exist = $this->check_if_tag_exists_on_a_question($t_id, $q_id);

        if (!$if_not_exist) {
//            TAG QUESTION
            try {
                $pdo = $this->pdo;
                $sql = 'INSERT INTO rel_question_tag (id_question, id_tag)
                    VALUES (:q_id, :t_id)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['q_id' => $q_id, 't_id' => $t_id]);

            } catch (PDOException $e) {
                echo "Error in SQL: " . $e->getMessage();
            }
        } else {
//             DETAG THE QUESTION
            try {
//                $pdo = $this->pdo;
//                $sql = 'DELETE FROM tag
//                    WHERE id = :t_id';
//                $stmt = $pdo->prepare($sql);
//                $stmt->execute(['t_id' => $t_id]);

                $pdo = $this->pdo;
                $sql = 'DELETE FROM rel_question_tag
                    WHERE id_question = :q_id AND id_tag = :t_id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['q_id' => $q_id, 't_id' => $t_id]);

            } catch (PDOException $e) {
                echo "Error in SQL: " . $e->getMessage();
            }
        }
    }

}


$con = new Model();

// EXAMPLE FOR DISPLAY QUESTIONS BY TAG_NAME
//$t = $con->display_all_questions_by_tags_name('test');
//$g = $t[0];
//echo $g->getMessage();

//$con->deleteAQuestion(2);

//$user = new User(12,'wad@wad.hu','asdf', '2020-10-10 10:10:10');
//$con->add_new_user($user);

//EXAMPLE FOR ASK QUESTION
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

// EXAMPLE FOR DISPLAY ALL TAGS
//$tags = $con->display_all_tags();
//var_dump($tags);
//foreach ($tags as $tag) {
//    foreach ($tag as $item) {
//        echo $item.'<br>';
//    }
//}

// EXAMPLE FOR DISPLAY QUESTIONS BY TAG_NAME
//$t = new Tag(1, 'hi!');
//$q = new Question(2, null, 1, 'new_tagger', 'working', 1, '2020-01-01 11:11:11');

// EXAMPLE FOR check_if_tag_exists_on_a_question
//$tag_id = 1;
//$question_id = 3;
//$res = $con->check_if_tag_exists_on_a_question($tag_id, $question_id);
//var_dump($res);


// EXAMPLE for
//$t = new Tag(1, 'hi!');
//$q = new Question(7, null, 1, 'new_tagger', 'working', 1, '2020-01-01 11:11:11');

//$con->add_tag_to_question($t, $q);
