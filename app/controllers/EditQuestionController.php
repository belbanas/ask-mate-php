<?php


namespace app\controllers;

use app\models\Model;
use Jenssegers\Blade\Blade;


class EditQuestionController
{
    public static function renderEditQuestionForm($q_id)
    {
        $model = new Model();
        $question = $model->display_a_question($q_id);
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('edit_question', ['question' => $question]);
    }

    public static function editQuestionHandler($q_id, $title, $message)
    {
        $model = new Model();
        $model->edit_question($q_id, $title, $message);

//        TODO: redirect here please!
        $questions = $model->list_questions();
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('questions', ['questions' => $questions]);
    }

}