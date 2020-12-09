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

    public static function renderEditQuestionForm($q_id)
    {
        $model = new Model();
        $question = $model->display_a_question($q_id);
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('edit_question', ['question' => $question]);
    }

    public static function editQuestionHandler($q_id)
    {
        $model = new Model();
        $question = $model->display_a_question($q_id);
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('eidtQuestionForm', ['questions' => $question]);
    }

}