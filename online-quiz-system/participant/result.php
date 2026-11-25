<?php

include("../includes/participant_auth.php");
include("../includes/db.php");


// Check attempt ID
if(!isset($_GET['attempt_id']))
{
    header("Location: dashboard.php");
    exit();
}


$attempt_id = intval($_GET['attempt_id']);


// Get quiz attempt
$result = mysqli_query(
    $conn,
    "SELECT *
     FROM quiz_attempts
     WHERE id='$attempt_id'
     AND user_id='" . $_SESSION['user_id'] . "'"
);


if(mysqli_num_rows($result) != 1)
{
    die("Quiz attempt not found.");
}


$row = mysqli_fetch_assoc($result);


// Calculate percentage
$percentage = 0;

if($row['total_questions'] > 0)
{
    $percentage =
        ($row['score'] / $row['total_questions']) * 100;
}


// ==========================================
// GET ANSWER STATISTICS
// ==========================================

$correct_count = 0;

$wrong_count = 0;

$unanswered_count = 0;


$answers_result = mysqli_query(
    $conn,
    "SELECT selected_answer, correct_answer
     FROM answers
     WHERE attempt_id='$attempt_id'"
);


while($answer_row = mysqli_fetch_assoc($answers_result))
{
    if($answer_row['selected_answer'] == 'unanswered')
    {
        $unanswered_count++;
    }
    elseif(
        $answer_row['selected_answer'] ==
        $answer_row['correct_answer']
    )
    {
        $correct_count++;
    }
    else
    {
        $wrong_count++;
    }
}


// ==========================================
// RESULT MESSAGE
// ==========================================

if($percentage >= 80)
{
    $message = "Excellent!";
    $color = "success";
    $icon = "🏆";
}
elseif($percentage >= 50)
{
    $message = "Good Job!";
    $color = "primary";
    $icon = "🎉";
}
else
{
    $message = "Keep Practicing!";
    $color = "danger";
    $icon = "📚";
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Quiz Result | QuizVerse</title>


<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
>


<link
    rel="stylesheet"
    href="../css/style.css"
>


<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

</head>


<body class="bg-light">


<?php include("../includes/header.php"); ?>


<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">


<!-- Result Card -->

<div class="card feature-card shadow-sm">

<div class="card-body text-center p-5">


<!-- Icon -->

<div style="font-size:70px;">

<?php echo $icon; ?>

</div>


<!-- Title -->

<h1 class="fw-bold mt-3">

Quiz Completed

</h1>


<p class="text-muted fs-5">

Here is your performance summary.

</p>


<hr class="my-4">


<!-- Score -->

<h2 class="display-4 fw-bold text-dark">

<?php echo $row['score']; ?>

<span class="text-secondary">/</span>

<?php echo $row['total_questions']; ?>

</h2>


<p class="text-muted">

Correct Answers

</p>


<!-- Percentage -->

<div class="display-6 fw-bold text-<?php echo $color; ?>">

<?php echo number_format($percentage, 1); ?>%

</div>


<span
    class="badge bg-<?php echo $color; ?> fs-6 mt-3 px-3 py-2"
>

<?php echo $message; ?>

</span>


<!-- Statistics -->

<div class="row mt-5 g-3">


<!-- Correct -->

<div class="col-md-4">

<div class="card border-success h-100">

<div class="card-body">

<div class="fs-2">
🟢
</div>

<h4 class="fw-bold text-success">

<?php echo $correct_count; ?>

</h4>

<p class="mb-0 text-muted">

Correct

</p>

</div>

</div>

</div>


<!-- Wrong -->

<div class="col-md-4">

<div class="card border-danger h-100">

<div class="card-body">

<div class="fs-2">
🔴
</div>

<h4 class="fw-bold text-danger">

<?php echo $wrong_count; ?>

</h4>

<p class="mb-0 text-muted">

Wrong

</p>

</div>

</div>

</div>


<!-- Unanswered -->

<div class="col-md-4">

<div class="card border-secondary h-100">

<div class="card-body">

<div class="fs-2">
⚪
</div>

<h4 class="fw-bold text-secondary">

<?php echo $unanswered_count; ?>

</h4>

<p class="mb-0 text-muted">

Unanswered

</p>

</div>

</div>

</div>


</div>


<!-- Buttons -->

<div class="row mt-5 g-3">


<!-- Review Answers -->

<div class="col-md-6">

<a
    href="review.php?attempt_id=<?php echo $attempt_id; ?>"
    class="btn btn-primary w-100"
>

<i class="bi bi-list-check me-1"></i>

Review Answers

</a>

</div>


<!-- Back Home -->

<div class="col-md-6">

<a
    href="dashboard.php"
    class="btn btn-dark w-100"
>

<i class="bi bi-house-door me-1"></i>

Back to Home

</a>

</div>


<!-- History -->

<div class="col-12">

<a
    href="history.php"
    class="btn btn-outline-dark w-100"
>

<i class="bi bi-clock-history me-1"></i>

View History

</a>

</div>


</div>


</div>

</div>


</div>

</div>


<footer class="text-center mt-5 text-secondary">

© <?php echo date("Y"); ?> QuizVerse

</footer>


<?php include("../includes/footer.php"); ?>


</body>

</html>