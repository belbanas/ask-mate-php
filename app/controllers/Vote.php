<?php


namespace app\controllers;


use app\models\Model;

class Vote
{
    public static function increaseVote(): void
    {
        $questionID = $_POST['id'];
        $model = new Model();
        $model->increaseVote($questionID);

        if (isset($_POST['q_id'])) {
            header('Location:/question?id=' . $_POST['q_id']);
        } else {
            header('Location:/');
        }
    }

    public static function decreaseVote(): void
    {
        $questionID = $_POST['id'];
        $model = new Model();
        $model->decreaseVote($questionID);

        if (isset($_POST['q_id'])) {
            header('Location:/question?id=' . $_POST['q_id']);
        } else {
            header('Location:/');
        }
    }

    public static function increaseAnswerVote(): void
    {
        $answerID = $_POST['id'];
        $model = new Model();
        $model->increaseAnswerVote($answerID);
        $answer = $model->getAnswerById($answerID);
        $questionID = $answer->getIdQuestion();
        header('Location:/question?id=' . $questionID);
    }

    public static function decreaseAnswerVote(): void
    {
        $answerID = $_POST['id'];
        $model = new Model();
        $model->decreaseAnswerVote($answerID);
        $answer = $model->getAnswerById($answerID);
        $questionID = $answer->getIdQuestion();
        header('Location:/question?id=' . $questionID);
    }


}