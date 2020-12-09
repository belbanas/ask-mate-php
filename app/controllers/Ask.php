<?php


namespace app\controllers;


use Jenssegers\Blade\Blade;

class Ask
{
    public static function renderAskQuestion()
    {
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('ask');
    }
}