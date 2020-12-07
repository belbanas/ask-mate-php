<?php

require_once __DIR__.'/vendor/autoload.php';

use app\models\Model;

$model= new Model();

var_dump($model->list_questions());
