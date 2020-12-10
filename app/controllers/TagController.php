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

}