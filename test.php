<?php

use app\models\Model;

require_once __DIR__ . '/vendor/autoload.php';

$model = new Model();
$model->deleteAQuestion(3);