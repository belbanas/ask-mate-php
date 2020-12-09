<?php


namespace app\controllers;

use app\models\Model;
use Jenssegers\Blade\Blade;


class Controller
{
    public static function renderQuestions()
    {
        $model = new Model();
        $questions = $model->list_questions();
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('questions', ['questions' => $questions]);
    }
}