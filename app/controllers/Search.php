<?php


namespace app\controllers;


use app\models\Model;
use Jenssegers\Blade\Blade;

class Search
{
    public static function renderSearch()
    {
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('search');
    }

    public static function findString()
    {
        $string = $_POST['string'];
        $model = new Model();
        $questions = $model->search($string);
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('results', ['questions' => $questions]);

    }

}