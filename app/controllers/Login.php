<?php


namespace app\controllers;


use Jenssegers\Blade\Blade;

class Login
{
    public static function renderLogin()
    {
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('login');
    }

    public static function loginUser()
    {
        //TODO
    }
}