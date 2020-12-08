<?php

use Jenssegers\Blade\Blade;

require_once __DIR__.'/vendor/autoload.php';

$blade = new Blade('./app/views', './cache');
echo $blade->render('questions', ['title' => 'kakkanat']);

