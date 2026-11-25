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
$attempt_query = mysqli_query(
    $conn,
    "SELECT *
     FROM quiz_attempts
     WHERE id='$attempt_id'
     AND user_id='" . $_SESSION['user_id'] . "'"
);


if(mysqli_num_rows($attempt_query) != 1)
{
    die("Quiz attempt not found.");
}


$attempt = mysqli_fetch_assoc($attempt_query);


// Get all questions and answers
$query = mysqli_query(
    $conn,
    "SELECT
        answers.question_id,
        answers.selected_answer,
        answers.correct_answer,
        questions.question,
        questions.option1,
        questions.option2,
        questions.option3,
        questions.option4
     FROM answers
     INNER JOIN questions
        ON answers.question_id = questions.id
     WHERE answers.attempt_id='$attempt_id'
     ORDER BY answers.question_id ASC"
);


$question_number = 0;

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Answer Review | QuizVerse</title>


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


<!-- Page Header -->

<div class="text-center mb-5">

<h1 class="fw-bold">

Answer Review

</h1>

<p class="text-muted">

Review your answers and learn from your mistakes.

</p>

</div>


<?php while($row = mysqli_fetch_assoc($query)) { ?>


<?php

$question_number++;


// Determine answer status
if($row['selected_answer'] == 'unanswered')
{
    $status = "unanswered";

    $status_text = "Unanswered";

    $status_color = "secondary";

    $status_icon = "⚪";
}
elseif($row['selected_answer'] == $row['correct_answer'])
{
    $status = "correct";

    $status_text = "Correct";

    $status_color = "success";

    $status_icon = "🟢";
}
else
{
    $status = "wrong";

    $status_text = "Wrong";

    $status_color = "danger";

    $status_icon = "🔴";
}


// Get selected answer text
$selected_text = "";

if($row['selected_answer'] == 'option1')
{
    $selected_text = $row['option1'];
}
elseif($row['selected_answer'] == 'option2')
{
    $selected_text = $row['option2'];
}
elseif($row['selected_answer'] == 'option3')
{
    $selected_text = $row['option3'];
}
elseif($row['selected_answer'] == 'option4')
{
    $selected_text = $row['option4'];
}


// Get correct answer text
$correct_text = "";

if($row['correct_answer'] == 'option1')
{
    $correct_text = $row['option1'];
}
elseif($row['correct_answer'] == 'option2')
{
    $correct_text = $row['option2'];
}
elseif($row['correct_answer'] == 'option3')
{
    $correct_text = $row['option3'];
}
elseif($row['correct_answer'] == 'option4')
{
    $correct_text = $row['option4'];
}

?>


<!-- Question Card -->

<div class="card shadow-sm border-0 mb-4">


<div class="card-body p-4">


<!-- Question Header -->

<div class="d-flex justify-content-between align-items-center mb-3">

<h5 class="fw-bold text-primary mb-0">

Question <?php echo $question_number; ?>

</h5>


<span class="badge bg-<?php echo $status_color; ?>">

<?php echo $status_icon; ?>

<?php echo $status_text; ?>

</span>

</div>


<!-- Question -->

<p class="fs-5 fw-semibold mb-4">

<?php echo htmlspecialchars($row['question']); ?>

</p>


<!-- Options -->

<div class="mb-4">


<!-- Option 1 -->

<div class="p-3 rounded border mb-2

<?php

if($row['correct_answer'] == 'option1')
{
    echo 'border-success bg-success-subtle';
}
elseif($row['selected_answer'] == 'option1')
{
    echo 'border-danger bg-danger-subtle';
}

?>

">

<strong>Option 1:</strong>

<?php echo htmlspecialchars($row['option1']); ?>


<?php if($row['correct_answer'] == 'option1') { ?>

<span class="badge bg-success ms-2">

Correct Answer

</span>

<?php } ?>


<?php if(
    $row['selected_answer'] == 'option1' &&
    $row['correct_answer'] != 'option1'
) { ?>

<span class="badge bg-danger ms-2">

Your Answer

</span>

<?php } ?>


</div>


<!-- Option 2 -->

<div class="p-3 rounded border mb-2

<?php

if($row['correct_answer'] == 'option2')
{
    echo 'border-success bg-success-subtle';
}
elseif($row['selected_answer'] == 'option2')
{
    echo 'border-danger bg-danger-subtle';
}

?>

">

<strong>Option 2:</strong>

<?php echo htmlspecialchars($row['option2']); ?>


<?php if($row['correct_answer'] == 'option2') { ?>

<span class="badge bg-success ms-2">

Correct Answer

</span>

<?php } ?>


<?php if(
    $row['selected_answer'] == 'option2' &&
    $row['correct_answer'] != 'option2'
) { ?>

<span class="badge bg-danger ms-2">

Your Answer

</span>

<?php } ?>


</div>


<!-- Option 3 -->

<div class="p-3 rounded border mb-2

<?php

if($row['correct_answer'] == 'option3')
{
    echo 'border-success bg-success-subtle';
}
elseif($row['selected_answer'] == 'option3')
{
    echo 'border-danger bg-danger-subtle';
}

?>

">

<strong>Option 3:</strong>

<?php echo htmlspecialchars($row['option3']); ?>


<?php if($row['correct_answer'] == 'option3') { ?>

<span class="badge bg-success ms-2">

Correct Answer

</span>

<?php } ?>


<?php if(
    $row['selected_answer'] == 'option3' &&
    $row['correct_answer'] != 'option3'
) { ?>

<span class="badge bg-danger ms-2">

Your Answer

</span>

<?php } ?>


</div>


<!-- Option 4 -->

<div class="p-3 rounded border mb-2

<?php

if($row['correct_answer'] == 'option4')
{
    echo 'border-success bg-success-subtle';
}
elseif($row['selected_answer'] == 'option4')
{
    echo 'border-danger bg-danger-subtle';
}

?>

">

<strong>Option 4:</strong>

<?php echo htmlspecialchars($row['option4']); ?>


<?php if($row['correct_answer'] == 'option4') { ?>

<span class="badge bg-success ms-2">

Correct Answer

</span>

<?php } ?>


<?php if(
    $row['selected_answer'] == 'option4' &&
    $row['correct_answer'] != 'option4'
) { ?>

<span class="badge bg-danger ms-2">

Your Answer

</span>

<?php } ?>


</div>


</div>


<?php if($status == "wrong") { ?>

<div class="alert alert-danger">

<strong>Your Answer:</strong>

<?php echo htmlspecialchars($selected_text); ?>

<br>

<strong>Correct Answer:</strong>

<?php echo htmlspecialchars($correct_text); ?>

</div>

<?php } ?>


<?php if($status == "correct") { ?>

<div class="alert alert-success">

<strong>Your Answer:</strong>

<?php echo htmlspecialchars($selected_text); ?>

</div>

<?php } ?>


<?php if($status == "unanswered") { ?>

<div class="alert alert-secondary">

<strong>You did not answer this question.</strong>

<br>

Correct Answer:

<?php echo htmlspecialchars($correct_text); ?>

</div>

<?php } ?>


</div>

</div>


<?php } ?>


<!-- Bottom Buttons -->

<div class="row justify-content-center mt-4 mb-5">


<div class="col-md-5 mb-3">

<a
    href="result.php?attempt_id=<?php echo $attempt_id; ?>"
    class="btn btn-outline-dark w-100"
>

<i class="bi bi-arrow-left me-1"></i>

Back to Result

</a>

</div>


<div class="col-md-5">

<a
    href="dashboard.php"
    class="btn btn-dark w-100"
>

<i class="bi bi-house-door me-1"></i>

Back to Home

</a>

</div>


</div>


<footer class="text-center text-secondary">

© <?php echo date("Y"); ?> QuizVerse

</footer>


</div>


<?php include("../includes/footer.php"); ?>


</body>

</html>