<?php

use app\models\Model;
use app\models\Question;
use Jenssegers\Blade\Blade;

require_once __DIR__.'/vendor/autoload.php';

$model= new Model();
$questions = $model->list_questions();

$blade = new Blade('./app/views', './cache');
echo $blade->render('questions', ['questions' => $questions]);


