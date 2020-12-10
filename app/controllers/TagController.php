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

        header('Location:/question?id=' . $q_id);
    }

    public static function removeTag(): void
    {
        $t_id = $_POST['t_id'];
        $model = new Model();
        $model->removeTag($t_id);

        header('Location:/tags');
    }

    public static function listAllTags(): void
    {

        $model = new Model();
        $tags = $model->display_all_tags();

        $blade = new Blade('./app/views', './cache');
        echo $blade->render('tags', ['tags' => $tags]);
    }


}