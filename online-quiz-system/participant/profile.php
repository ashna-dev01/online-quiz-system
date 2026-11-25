<?php

include("../includes/participant_auth.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];


// =====================================================
// GET USER INFORMATION
// =====================================================

$result = mysqli_query(
    $conn,
    "SELECT *
     FROM users
     WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($result);



// =====================================================
// QUIZ STATISTICS
// =====================================================

// Total attempts

$attempt_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_attempts
     FROM quiz_attempts
     WHERE user_id='$user_id'"
);

$attempt_data = mysqli_fetch_assoc($attempt_query);

$total_attempts = $attempt_data['total_attempts'];



// Best score

$best_query = mysqli_query(
    $conn,
    "SELECT
        score,
        total_questions
     FROM quiz_attempts
     WHERE user_id='$user_id'
     ORDER BY
        (score / NULLIF(total_questions,0)) DESC
     LIMIT 1"
);

$best_score = 0;

if(mysqli_num_rows($best_query) == 1)
{
    $best_data = mysqli_fetch_assoc($best_query);

    if($best_data['total_questions'] > 0)
    {
        $best_score =
            ($best_data['score'] / $best_data['total_questions']) * 100;
    }
}



// Average score

$average_query = mysqli_query(
    $conn,
    "SELECT
        AVG(score / NULLIF(total_questions,0) * 100) AS average_score
     FROM quiz_attempts
     WHERE user_id='$user_id'"
);

$average_data = mysqli_fetch_assoc($average_query);

$average_score = $average_data['average_score'] ?? 0;



// =====================================================
// RECENT ATTEMPT
// =====================================================

$recent_query = mysqli_query(
    $conn,
    "SELECT
        quiz_attempts.score,
        quiz_attempts.total_questions,
        quiz_attempts.attempt_date,
        categories.category_name
     FROM quiz_attempts
     INNER JOIN categories
        ON quiz_attempts.category_id = categories.id
     WHERE quiz_attempts.user_id='$user_id'
     ORDER BY quiz_attempts.attempt_date DESC
     LIMIT 1"
);

$recent_attempt = null;

if(mysqli_num_rows($recent_query) == 1)
{
    $recent_attempt = mysqli_fetch_assoc($recent_query);

    if($recent_attempt['total_questions'] > 0)
    {
        $recent_percentage =
            ($recent_attempt['score'] /
            $recent_attempt['total_questions']) * 100;
    }
    else
    {
        $recent_percentage = 0;
    }
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

<title>Profile | QuizVerse</title>


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


<!-- =====================================================
     NAVIGATION
===================================================== -->

<nav
    class="navbar navbar-expand-lg shadow"
    style="background:#1E293B;"
>

<div class="container">


<a
    class="navbar-brand text-white"
    href="dashboard.php"
>

<span class="d-block fw-bold fs-3">

QuizVerse

</span>

<small style="color:#CBD5E1;">

Learn • Compete • Grow

</small>

</a>


<div class="ms-auto d-flex align-items-center gap-3">


<a
    href="history.php"
    class="nav-link text-white"
>

<i class="bi bi-clock-history me-1"></i>

History

</a>


<a
    href="profile.php"
    class="nav-link text-white"
>

<i class="bi bi-person-circle me-1"></i>

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



<!-- =====================================================
     PROFILE
===================================================== -->

<div class="container py-5">


<!-- Profile Header -->

<div class="text-center mb-5">


<div
    class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
    style="width:100px;height:100px;"
>

<i class="bi bi-person-fill display-4"></i>

</div>


<h1 class="fw-bold mt-3 mb-1">

<?php echo htmlspecialchars($user['name']); ?>

</h1>


<p class="text-muted mb-0">

Participant

</p>


</div>



<!-- =====================================================
     INFORMATION + STATISTICS
===================================================== -->

<div class="row g-4 mb-4">


<!-- Personal Information -->

<div class="col-lg-6">


<div class="card feature-card h-100">


<div class="card-body p-4">


<h4 class="fw-bold mb-4">

<i class="bi bi-person-vcard text-primary me-2"></i>

Personal Information

</h4>


<div class="mb-4">


<small class="text-muted">

Full Name

</small>


<div class="fw-semibold fs-5">

<?php echo htmlspecialchars($user['name']); ?>

</div>


</div>



<div class="mb-4">


<small class="text-muted">

Email Address

</small>


<div class="fw-semibold">

<?php echo htmlspecialchars($user['email']); ?>

</div>


</div>



<?php if(isset($user['created_at'])) { ?>


<div>


<small class="text-muted">

Member Since

</small>


<div class="fw-semibold">

<?php

echo date(
    "d M Y",
    strtotime($user['created_at'])
);

?>

</div>


</div>


<?php } ?>


</div>

</div>

</div>



<!-- Quiz Statistics -->

<div class="col-lg-6">


<div class="card feature-card h-100">


<div class="card-body p-4">


<h4 class="fw-bold mb-4">

<i class="bi bi-bar-chart-line text-primary me-2"></i>

Quiz Statistics

</h4>


<div class="row g-3">


<div class="col-6">


<div class="border rounded-3 p-3">


<small class="text-muted">

Total Attempts

</small>


<h3 class="fw-bold mb-0">

<?php echo $total_attempts; ?>

</h3>


</div>

</div>



<div class="col-6">


<div class="border rounded-3 p-3">


<small class="text-muted">

Best Score

</small>


<h3 class="fw-bold mb-0">

<?php echo round($best_score); ?>%

</h3>


</div>

</div>



<div class="col-12">


<div class="border rounded-3 p-3">


<div class="d-flex justify-content-between">


<small class="text-muted">

Average Score

</small>


<strong>

<?php echo round($average_score); ?>%

</strong>


</div>


<div
    class="progress mt-2"
    style="height:8px;"
>


<div
    class="progress-bar"
    style="width: <?php echo min($average_score,100); ?>%;"
>

</div>


</div>


</div>

</div>


</div>


</div>

</div>

</div>


</div>



<!-- =====================================================
     RECENT PERFORMANCE
===================================================== -->

<div class="card shadow-sm border-0">


<div class="card-body p-4">


<h4 class="fw-bold mb-4">

<i class="bi bi-clock-history text-primary me-2"></i>

Recent Performance

</h4>



<?php if($recent_attempt !== null) { ?>


<div class="row align-items-center">


<div class="col-md-6">


<small class="text-muted">

Last Quiz

</small>


<h4 class="fw-bold mb-1">

<?php

echo htmlspecialchars(
    $recent_attempt['category_name']
);

?>

</h4>


<p class="text-muted mb-md-0">


<?php

echo date(
    "d M Y, h:i A",
    strtotime($recent_attempt['attempt_date'])
);

?>


</p>


</div>



<div class="col-md-3">


<small class="text-muted">

Score

</small>


<div class="fw-bold fs-4">

<?php echo $recent_attempt['score']; ?>

/

<?php echo $recent_attempt['total_questions']; ?>

</div>


</div>



<div class="col-md-3">


<small class="text-muted">

Result

</small>


<div>


<?php

if($recent_percentage >= 50)

{

?>


<span class="badge bg-success fs-6">

<?php echo number_format($recent_percentage,1); ?>%

Passed

</span>


<?php

}

else

{

?>


<span class="badge bg-danger fs-6">

<?php echo number_format($recent_percentage,1); ?>%

Failed

</span>


<?php

}

?>


</div>


</div>


</div>


<?php } else { ?>


<div class="text-center py-3">


<div class="fs-1">

📚

</div>


<h5 class="fw-bold">

No quizzes attempted yet

</h5>


<p class="text-muted">

Take your first quiz and your performance will appear here.

</p>


<a
    href="dashboard.php"
    class="btn btn-dark"
>

Start a Quiz

<i class="bi bi-arrow-right ms-1"></i>

</a>


</div>


<?php } ?>


</div>

</div>



<!-- =====================================================
     ACTIONS
===================================================== -->

<div class="text-center mt-4">


<a
    href="dashboard.php"
    class="btn btn-dark px-4 me-2"
>

<i class="bi bi-house-door me-1"></i>

Dashboard

</a>


<a
    href="history.php"
    class="btn btn-outline-dark px-4"
>

<i class="bi bi-clock-history me-1"></i>

Quiz History

</a>

<a
    href="leaderboard.php"
    class="btn btn-outline-dark px-4"
>

    <i class="bi bi-trophy me-1"></i>

    Leaderboard

</a>

</div>



<!-- Footer -->

<?php include("../includes/footer.php"); ?>

</div>


</body>

</html>