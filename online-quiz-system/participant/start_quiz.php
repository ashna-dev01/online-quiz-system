<?php

include("../includes/participant_auth.php");
include("../includes/db.php");


// Get category ID
if(!isset($_GET['category_id']))
{
    header("Location: dashboard.php");
    exit();
}


$category_id = intval($_GET['category_id']);


// Get 20 random questions from this category
$query = mysqli_query(
    $conn,
    "SELECT id
     FROM questions
     WHERE category_id='$category_id'
     ORDER BY RAND()
     LIMIT 20"
);


// Check if enough questions exist
if(mysqli_num_rows($query) < 20)
{
    die("Not enough questions available for this quiz.");
}


// Store question IDs
$question_ids = [];


while($row = mysqli_fetch_assoc($query))
{
    $question_ids[] = $row['id'];
}


// Store quiz information in session
$_SESSION['quiz_category'] = $category_id;

$_SESSION['quiz_questions'] = $question_ids;

$_SESSION['current_question'] = 0;

$_SESSION['quiz_answers'] = [];

$_SESSION['quiz_answers'] = [];

// Start 15-minute quiz timer
$_SESSION['quiz_end_time'] = time() + (15 * 60);

// ==========================================
// QUIZ TIMER
// ==========================================

// Quiz duration: 15 minutes
$quiz_duration = 15 * 60;


// Store the exact time when the quiz starts
$_SESSION['quiz_start_time'] = time();


// Store when the quiz should end
$_SESSION['quiz_end_time'] = time() + $quiz_duration;


// Start first question
header("Location: question.php");

exit();

?>