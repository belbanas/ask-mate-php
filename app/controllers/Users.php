<?php


namespace app\controllers;


use app\models\Model;
use app\models\User;
use Jenssegers\Blade\Blade;

class Users
{
    public static function listAllUsers()
    {
        $model = new Model();
        $users = $model->listAllUsers();
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('users', ['users' => $users]);
    }

}