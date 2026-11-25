<?php

include("../includes/participant_auth.php");
include("../includes/db.php");


$user_id = $_SESSION['user_id'];


// Get quiz history
$query = mysqli_query(
    $conn,
    "
    SELECT
        quiz_attempts.id AS attempt_id,
        quiz_attempts.score,
        quiz_attempts.total_questions,
        quiz_attempts.attempt_date,
        categories.category_name
    FROM quiz_attempts
    INNER JOIN categories
        ON quiz_attempts.category_id = categories.id
    WHERE quiz_attempts.user_id='$user_id'
    ORDER BY quiz_attempts.attempt_date DESC
    "
);


$totalAttempts = mysqli_num_rows($query);


$bestScore = 0;

$totalScore = 0;

$data = [];


while($row = mysqli_fetch_assoc($query))
{
    $data[] = $row;


    if($row['total_questions'] > 0)
    {
        $percentage =
            ($row['score'] / $row['total_questions']) * 100;
    }
    else
    {
        $percentage = 0;
    }


    $totalScore += $percentage;


    if($percentage > $bestScore)
    {
        $bestScore = $percentage;
    }
}


$average = $totalAttempts
    ? $totalScore / $totalAttempts
    : 0;

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Quiz History | QuizVerse</title>


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


<!-- Navigation -->

<nav class="navbar navbar-expand-lg shadow">

<div class="container">


<a
    class="navbar-brand text-white"
    href="dashboard.php"
>

<span class="d-block fw-bold fs-3">

QuizVerse

</span>

<small style="display:block;color:#CBD5E1;">

Learn • Compete • Grow

</small>

</a>


<div class="ms-auto d-flex align-items-center gap-3">


<a
    href="history.php"
    class="nav-link text-white"
>

<i class="bi bi-clock-history"></i>

History

</a>

<a
    href="leaderboard.php"
    class="nav-link text-white"
>

    <i class="bi bi-trophy me-1"></i>

    Leaderboard

</a>

<a
    href="profile.php"
    class="nav-link text-white"
>

<i class="bi bi-person-circle"></i>

<?php echo htmlspecialchars($_SESSION['user_name']); ?>

</a>


<a
    href="../logout.php"
    class="btn btn-outline-light"
>

Logout

</a>


</div>

</div>

</nav>



<!-- Main Content -->

<div class="container py-5">


<!-- Page Header -->

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h1 class="fw-bold mb-1">

Quiz History

</h1>

<p class="text-muted mb-0">

Track your quiz performance and review previous attempts.

</p>

</div>


<a
    href="dashboard.php"
    class="btn btn-dark"
>

<i class="bi bi-arrow-left me-1"></i>

Back

</a>

</div>



<!-- Statistics -->

<div class="row g-4 mb-5">


<!-- Total Attempts -->

<div class="col-md-4">

<div class="card stats-card p-4 h-100">

<div class="d-flex justify-content-between align-items-center">

<div>

<small class="text-muted">

Total Attempts

</small>

<h2 class="fw-bold mb-0">

<?php echo $totalAttempts; ?>

</h2>

</div>

<div class="fs-1">

📝

</div>

</div>

</div>

</div>



<!-- Best Score -->

<div class="col-md-4">

<div class="card stats-card p-4 h-100">

<div class="d-flex justify-content-between align-items-center">

<div>

<small class="text-muted">

Best Score

</small>

<h2 class="fw-bold mb-0">

<?php echo round($bestScore); ?>%

</h2>

</div>

<div class="fs-1">

🏆

</div>

</div>

</div>

</div>



<!-- Average -->

<div class="col-md-4">

<div class="card stats-card p-4 h-100">

<div class="d-flex justify-content-between align-items-center">

<div>

<small class="text-muted">

Average Score

</small>

<h2 class="fw-bold mb-0">

<?php echo round($average); ?>%

</h2>

</div>

<div class="fs-1">

📊

</div>

</div>

</div>

</div>


</div>



<!-- History -->

<div class="card shadow-sm border-0">

<div class="card-body p-4">


<div class="d-flex justify-content-between align-items-center mb-4">

<h4 class="fw-bold mb-0">

Previous Attempts

</h4>

<span class="text-muted">

<?php echo $totalAttempts; ?> attempt(s)

</span>

</div>



<?php if($totalAttempts == 0) { ?>


<!-- No Attempts -->

<div class="text-center py-5">

<div class="fs-1 mb-3">

📚

</div>

<h4 class="fw-bold">

No quizzes attempted yet

</h4>

<p class="text-muted">

Take your first quiz to see your performance here.

</p>

<a
    href="dashboard.php"
    class="btn btn-primary"
>

<i class="bi bi-play-fill me-1"></i>

Take a Quiz

</a>

</div>


<?php } else { ?>


<!-- Desktop Table -->

<div class="table-responsive">

<table class="table align-middle">

<thead>

<tr>

<th>#</th>

<th>Category</th>

<th>Score</th>

<th>Percentage</th>

<th>Status</th>

<th>Date</th>

<th class="text-center">Actions</th>

</tr>

</thead>


<tbody>


<?php

$number = 1;

foreach($data as $row)

{

    if($row['total_questions'] > 0)
    {
        $percentage =
            ($row['score'] / $row['total_questions']) * 100;
    }
    else
    {
        $percentage = 0;
    }


    if($percentage >= 50)
    {
        $status = "Passed";

        $status_color = "success";
    }
    else
    {
        $status = "Failed";

        $status_color = "danger";
    }


    if($percentage >= 80)
    {
        $score_color = "success";
    }
    elseif($percentage >= 50)
    {
        $score_color = "primary";
    }
    else
    {
        $score_color = "danger";
    }

?>


<tr>


<td>

<?php echo $number; ?>

</td>


<td>

<span class="fw-semibold">

<?php echo htmlspecialchars($row['category_name']); ?>

</span>

</td>


<td>

<strong>

<?php echo $row['score']; ?>

/

<?php echo $row['total_questions']; ?>

</strong>

</td>


<td>

<strong class="text-<?php echo $score_color; ?>">

<?php echo number_format($percentage, 1); ?>%

</strong>

</td>


<td>

<span class="badge bg-<?php echo $status_color; ?>">

<?php echo $status; ?>

</span>

</td>


<td>

<div>

<?php

echo date(
    "d M Y",
    strtotime($row['attempt_date'])
);

?>

</div>

<small class="text-muted">

<?php

echo date(
    "h:i A",
    strtotime($row['attempt_date'])
);

?>

</small>

</td>


<td>


<div class="d-flex justify-content-center gap-2">


<!-- Result -->

<a
    href="result.php?attempt_id=<?php echo $row['attempt_id']; ?>"
    class="btn btn-sm btn-outline-dark"
    title="View Result"
>

<i class="bi bi-bar-chart"></i>

</a>


<!-- Review -->

<a
    href="review.php?attempt_id=<?php echo $row['attempt_id']; ?>"
    class="btn btn-sm btn-outline-primary"
    title="Review Answers"
>

<i class="bi bi-list-check"></i>

</a>


</div>


</td>


</tr>


<?php

$number++;

}

?>


</tbody>

</table>

</div>


<?php } ?>


</div>

</div>



<!-- Footer -->

<?php include("../includes/footer.php"); ?>

</div>


</body>

</html>