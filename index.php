<?php
session_start();

use app\controllers\Controller;
use app\controllers\EditQuestionController;
use app\controllers\Delete;
use app\controllers\Login;
use app\controllers\Registration;
use app\controllers\Vote;
use app\models\Model;
use Jenssegers\Blade\Blade;
use app\controllers\Route;

require_once __DIR__ . '/vendor/autoload.php';

Route::add('/', function () {
    Controller::renderQuestions();
});

Route::add('/login', function () {
    Login::renderLogin();
}, 'get');

Route::add('/login', function () {
    Login::loginUser();
}, 'post');

Route::add('/registration', function () {
    Registration::renderRegistration();
}, 'get');

Route::add('/registration', function () {
    Registration::registerUser();
}, 'post');

// Post route example
Route::add('/delete', function () {
    Delete::deleteAQuestion();
}, 'post');

Route::add('/increase', function () {
    Vote::increaseVote();
}, 'post');

Route::add('/decrease', function () {
    Vote::decreaseVote();
}, 'post');

Route::add('/logout', function () {
    Login::logoutUser();
});

Route::add('/edit_question_form', function () {
    $q_id = $_GET["q_id"];
    EditQuestionController::renderEditQuestionForm($q_id);
}, 'get');

Route::add('/edit_question_handler', function () {
    $q_id = $_POST["id"];
    $title = $_POST["title"];
    $message = $_POST["message"];
    EditQuestionController::editQuestionHandler($q_id, $title, $message);
}, 'post');

Route::run('/');

