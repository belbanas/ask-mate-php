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

    public function display_a_questions_all_answers(int $question_id): array
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

    public function edit_question($q_id, $new_title, $new_message): void
    {
        $old_question = $this->display_a_question($q_id);

        try {
            $pdo = $this->pdo;
            $sql = 'UPDATE question
                    SET title = :new_title, message = :new_message
                    WHERE id=:q_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['new_title' => $new_title, 'new_message' => $new_message, 'q_id' => $q_id]);
        } catch (PDOException $e) {
            echo "Error in SQL: " . $e->getMessage();
        }
    }

    public function listAllUsers()
    {
        $pdo = $this->pdo;
        $sql = 'SELECT * FROM registered_user ORDER BY id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $users = array();
        foreach ($result as $row) {
            $questionsNumber = $this->countUserQuestions($row['id']);
            $answersNumber = $this->countAnsweredQuestions($row['id']);
            $user = new User($row['id'], $row['email'], $row['password_hash'], $row['registration_time'], $questionsNumber, $answersNumber);
            array_push($users, $user);
        }
        return $users;
    }

    public function countUserQuestions(int $id): int
    {
        $pdo = $this->pdo;
        $sql = "SELECT COUNT(*) as count FROM question WHERE id_registered_user = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result['count'];
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

    public function countAnsweredQuestions(int $id): int
    {
        $pdo = $this->pdo;
        $sql = "SELECT COUNT(*) as count FROM answer WHERE id_registered_user = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result['count'];
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

    // TODO
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

    public function saveAnswer(int $questionId, string $idRegisteredUser, string $message): void
    {
        $pdo = $this->pdo;
        $sql = 'INSERT INTO answer (id_question, id_registered_user, message, vote_number)
                VALUES (:questionId, :idRegisteredUser, :message, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['questionId' => $questionId, 'idRegisteredUser' => $idRegisteredUser, 'message' => $message]);
    }


}