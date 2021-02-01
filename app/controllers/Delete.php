<?php


namespace app\controllers;


use app\models\Model;
use app\models\User;

class Delete
{

    public static function deleteAQuestion(): void
    {
        $questionID = $_POST['id'];
        $model = new Model();
        $model->deleteAQuestion($questionID);
        header('Location:/');
    }

    public static function deleteAnAnswer(): void
    {
        $answerID = $_POST['id'];
        $model = new Model();
        $model->deleteAnAnswer($answerID);
        header('Location:/');
    }

}