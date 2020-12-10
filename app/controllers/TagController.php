<?php


namespace app\controllers;


use app\models\Model;
use app\models\Tag;
use Jenssegers\Blade\Blade;

class TagController
{
    public static function addTag(): void
    {
        $tagName = $_POST['tagName'];
        $q_id = $_POST['q_id'];

        $model = new Model();
        $model->add_tag_to_question($tagName, $q_id);

        header('Location:/');
    }

    public static function deTag(): void
    {
        $q_id = $_POST['q_id'];
        $t_id = $_POST['t_id'];
        echo $q_id;
        echo $t_id;

        $model = new Model();
        $model->detagQuestion($q_id, $t_id);

        header('Location:/');
    }



}