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

}