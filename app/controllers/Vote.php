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
        header('Location:/');
    }

    public static function decreaseVote(): void
    {
        $questionID = $_POST['id'];
        $model = new Model();
        $model->decreaseVote($questionID);
        header('Location:/');
    }


}