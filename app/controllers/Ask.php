<?php


namespace app\controllers;


use app\models\Image;
use app\models\Model;
use app\models\Question;
use Jenssegers\Blade\Blade;

class Ask
{
    public static function renderAskQuestion(): void
    {
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('ask');
    }

    public static function askQuestion(): void
    {
        $model = new Model();
        $user = $model->getUserByEmail($_SESSION['email']);
        $idRegisteredUser = $user->getId();
        $idImage = null;
        $title = $_POST['title'];
        $message = $_POST['message'];
        if ($_FILES['image']['name'] != null) {
            $image = new Image(null, $_FILES['image']['name'], null);
            $model->saveImage($image);
            $image->saveImage();
            $idImage = $model->getLastImageId();
        }
        $question = new Question(null, $idImage, $idRegisteredUser, $title, $message, 0, null);
        $model->ask_question($question);
        header('Location:/');
    }
}