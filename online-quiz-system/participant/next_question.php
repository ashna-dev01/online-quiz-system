<?php

include("../includes/participant_auth.php");


// Check if quiz session exists
if(
    !isset($_SESSION['quiz_questions']) ||
    !isset($_SESSION['current_question'])
)
{
    header("Location: dashboard.php");
    exit();
}


// Make sure an answer was selected
if(!isset($_POST['answer']))
{
    header("Location: question.php");
    exit();
}


// Get current question number
$current = $_SESSION['current_question'];


// Get the selected question IDs
$question_ids = $_SESSION['quiz_questions'];


// Make sure the current question exists
if(!isset($question_ids[$current]))
{
    header("Location: dashboard.php");
    exit();
}


// Get current question ID
$question_id = $question_ids[$current];


// Save the participant's answer
$_SESSION['quiz_answers'][$question_id] = $_POST['answer'];


// Move to the next question
$_SESSION['current_question']++;


// Check whether all questions are completed
if(
    $_SESSION['current_question'] >= count($_SESSION['quiz_questions'])
)
{
    header("Location: submit_quiz.php");
    exit();
}


// Show the next question
header("Location: question.php");
exit();

?>