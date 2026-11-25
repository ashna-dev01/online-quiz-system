<?php

include("../includes/participant_auth.php");
include("../includes/db.php");


// Check whether quiz session exists
if(
    !isset($_SESSION['quiz_category']) ||
    !isset($_SESSION['quiz_questions']) ||
    !isset($_SESSION['quiz_answers'])
)
{
    header("Location: dashboard.php");
    exit();
}


// Get quiz information
$user_id = $_SESSION['user_id'];

$category_id = $_SESSION['quiz_category'];

$question_ids = $_SESSION['quiz_questions'];

$answers = $_SESSION['quiz_answers'];


// Check whether quiz ended because of timer
$timeout = isset($_GET['timeout']) && $_GET['timeout'] == 1;


// Calculate score
$score = 0;

$total_questions = count($question_ids);


// Store correct answers temporarily
$correct_answers = [];


// Check every question
foreach($question_ids as $question_id)
{
    // Get correct answer
    $query = mysqli_query(
        $conn,
        "SELECT correct_answer
         FROM questions
         WHERE id='$question_id'"
    );


    if(mysqli_num_rows($query) == 1)
    {
        $row = mysqli_fetch_assoc($query);

        $correct_answer = $row['correct_answer'];

        $correct_answers[$question_id] = $correct_answer;


        // Check participant's answer
        if(isset($answers[$question_id]))
        {
            $selected_answer = $answers[$question_id];

            if($selected_answer == $correct_answer)
            {
                $score++;
            }
        }
    }
}


// Save quiz attempt
$sql = "
    INSERT INTO quiz_attempts
    (user_id, category_id, score, total_questions)
    VALUES
    ('$user_id', '$category_id', '$score', '$total_questions')
";


if(!mysqli_query($conn, $sql))
{
    die("Error saving quiz attempt: " . mysqli_error($conn));
}


$attempt_id = mysqli_insert_id($conn);


// Save individual answers
foreach($question_ids as $question_id)
{
    // Check whether participant answered
    if(isset($answers[$question_id]))
    {
        $selected_answer = $answers[$question_id];
    }
    else
    {
        // Mark unanswered questions
        $selected_answer = "unanswered";
    }


    $correct_answer = $correct_answers[$question_id];


    mysqli_query(
        $conn,
        "INSERT INTO answers
        (attempt_id, question_id, selected_answer, correct_answer)
        VALUES
        ('$attempt_id',
         '$question_id',
         '$selected_answer',
         '$correct_answer')"
    );
}


// Clear quiz session
unset($_SESSION['quiz_category']);

unset($_SESSION['quiz_questions']);

unset($_SESSION['current_question']);

unset($_SESSION['quiz_answers']);

unset($_SESSION['quiz_start_time']);

unset($_SESSION['quiz_end_time']);


// Go to result page
header("Location: result.php?attempt_id=" . $attempt_id);

exit();

?>