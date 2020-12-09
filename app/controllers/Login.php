<?php


namespace app\controllers;


use app\models\Model;
use Jenssegers\Blade\Blade;

class Login
{
    public static function renderLogin(): void
    {
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('login');
    }

    public static function loginUser(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $model = new Model();
        $user = $model->getUserByEmail($email);
        if (!password_verify($password, $user->getPasswordHash())) {
            $message = "Wrong username or password";
            echo "<script type='text/javascript'>alert('$message');</script>";
            self::renderLogin();
        } else {
            $_SESSION['email'] = $email;
            header('Location:/');
        }
    }

    public static function logoutUser()
    {
        session_unset();
        session_destroy();
        $message = "You are logged out successfully.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header('Location:/');
    }
}