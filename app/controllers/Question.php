<?php


namespace app\controllers;


use app\models\Model;
use Jenssegers\Blade\Blade;

class Question
{
    public static function displayAQuestion(): void
    {
        $questionID = $_GET['id'];
        $model = new Model();
        $question = $model->display_a_question($questionID);
        $answers = $model->display_a_questions_all_answers($questionID);
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('question', ['question' => $question, 'answers' => $answers]);
    }

}