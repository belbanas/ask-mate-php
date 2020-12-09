<?php


namespace app\controllers;


use app\models\Model;
use app\models\User;
use Jenssegers\Blade\Blade;

class Registration
{
    public static function renderRegistration(): void
    {
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('registration');
    }

    public static function registerUser(): void
    {
        $email = $_POST['email'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user = new User(null, $email, $passwordHash, null);
        $model = new Model();
        $model->add_new_user($user);
        header('Location:/');
    }


}