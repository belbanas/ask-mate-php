<?php


namespace app\controllers;


use app\models\Model;
use Jenssegers\Blade\Blade;

class AddAnswer
{
    public static function renderAddAnswer()
    {
        $questionID = $_GET['question_id'];
        $model = new Model();
        $question = $model->display_a_question($questionID);
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('answer', ['question' => $question]);
    }

    public static function saveAnswer()
    {
        $model = new Model();
        $questionID = $_POST['question_id'];
        $user = $model->getUserByEmail($_SESSION['email']);
        $idRegisteredUser = $user->getId();
        $message = $_POST['message'];
        $model->saveAnswer($questionID, $idRegisteredUser, $message);
        header('Location:/question?id='.$questionID);
    }
}