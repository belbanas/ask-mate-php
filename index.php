<?php

use app\controllers\Delete;
use app\controllers\Login;
use app\controllers\Question;
use app\controllers\Registration;
use app\controllers\Vote;
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
},'get');

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
Route::add('/delete', function () {
    Delete::deleteAQuestion();
    Delete::deleteAnAnswer();
}, 'post');

Route::add('/increase-question', function () {
    Vote::increaseVote();
}, 'post');

Route::add('/increase-answer', function () {
    Vote::increaseAnswerVote();
}, 'post');

Route::add('/decrease-question', function () {
    Vote::decreaseVote();
}, 'post');

Route::add('/decrease-answer', function () {
    Vote::decreaseAnswerVote();
}, 'post');

Route::add('/question', function () {
    Question::displayAQuestion();
},'get');


// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/foo/([0-9]*)/bar', function ($var1) {
    echo $var1 . ' is a great number!';
});

Route::run('/');

