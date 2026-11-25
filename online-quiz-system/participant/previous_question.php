<?php

include("../includes/participant_auth.php");


// Check whether quiz session exists
if(
    !isset($_SESSION['quiz_questions']) ||
    !isset($_SESSION['current_question'])
)
{
    header("Location: dashboard.php");
    exit();
}


// Get current question
$current = $_SESSION['current_question'];

$question_ids = $_SESSION['quiz_questions'];


// Make sure current question exists
if(isset($question_ids[$current]))
{
    $question_id = $question_ids[$current];

    // Save the current answer if one was selected
    if(isset($_POST['answer']))
    {
        $_SESSION['quiz_answers'][$question_id] = $_POST['answer'];
    }
}


// Move to previous question
if($_SESSION['current_question'] > 0)
{
    $_SESSION['current_question']--;
}


// Return to question page
header("Location: question.php");
exit();

?>