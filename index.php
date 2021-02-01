<?php
session_start();

use app\controllers\AddAnswer;
use app\controllers\Ask;
use app\controllers\Controller;
use app\controllers\EditQuestionController;
use app\controllers\Delete;
use app\controllers\Login;
use app\controllers\Question;
use app\controllers\Registration;
use app\controllers\Users;
use app\controllers\Vote;
use app\controllers\Route;
use app\models\Answer;

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
}, 'get');

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

Route::add('/ask', function () {
    Ask::renderAskQuestion();
}, 'get');

Route::add('/ask', function () {
    Ask::askQuestion();
}, 'post');

Route::add('/tags', function () {
    \app\controllers\TagController::listAllTags();
}, 'get');

Route::add('/doSearch', function () {
    $itemForSearch = $_POST['itemForSearch'];
    \app\controllers\SearchController::doSearch($itemForSearch);
}, 'post');

Route::add('/add-answer', function () {
    AddAnswer::renderAddAnswer();
}, 'get');

Route::add('/add-answer', function () {
    AddAnswer::saveAnswer();
}, 'post');

Route::add('/users', function () {
    Users::listAllUsers();
});

Route::add('/tagQuestion', function () {
    \app\controllers\TagController::addTag();
}, 'post');

Route::add('/deTag', function () {
    \app\controllers\TagController::deTag();
}, 'post');

Route::add('/removeTag', function () {
    $t_id = $_POST["t_id"];
    \app\controllers\TagController::removeTag($t_id);
}, 'post');

Route::run('/');

