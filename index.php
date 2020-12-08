<?php

use app\controllers\Login;
use app\controllers\Registration;
use app\models\Model;
use Jenssegers\Blade\Blade;
use app\controllers\Route;

require_once __DIR__ . '/vendor/autoload.php';

// Add base route (startpage)
Route::add('/', function () {
    $model = new Model();
    $questions = $model->list_questions();
    $blade = new Blade('./app/views', './cache');
    echo $blade->render('questions', ['questions' => $questions]);
});

// Simple test route that simulates static html file
Route::add('/login', function () {
    Login::renderLogin();
}, 'get');

Route::add('/login', function () {
    Login::loginUser();
}, 'post');

// Post route example
Route::add('/registration', function () {
    Registration::renderRegistration();
}, 'get');

Route::add('/registration', function () {
    Registration::registerUser();
}, 'post');

// Post route example
Route::add('/contact-form', function () {
    echo 'Hey! The form has been sent:<br/>';
    print_r($_POST);
}, 'post');

// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/foo/([0-9]*)/bar', function ($var1) {
    echo $var1 . ' is a great number!';
});

Route::run('/');

