<?php


namespace app\controllers;

use app\models\Model;
use Jenssegers\Blade\Blade;


class Controller
{
    private Model $model;
    private Blade $blade;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->model = new Model();
        $this->blade = new Blade('./app/views', './cache');
    }

    public function invoke()
    {
        if (isset($_GET['register'])) {
            echo "kaki";
        } else {
            $questions = $this->model->list_questions();
            echo $this->blade->render('questions', ['questions' => $questions]);
        }
    }
}