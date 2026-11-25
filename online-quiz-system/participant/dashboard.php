<?php

include("../includes/participant_auth.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];


// =====================================================
// PARTICIPANT STATISTICS
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


// Total categories
$category_count_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_categories
     FROM categories"
);

$category_count_data = mysqli_fetch_assoc($category_count_query);

$total_categories = $category_count_data['total_categories'];


// =====================================================
// RECENT QUIZ ATTEMPTS
// =====================================================

$recent_query = mysqli_query(
    $conn,
    "SELECT
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
     LIMIT 5"
);


// =====================================================
// CATEGORIES
// =====================================================

$category_query = mysqli_query(
    $conn,
    "SELECT *
     FROM categories
     ORDER BY category_name ASC"
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Dashboard | QuizVerse</title>


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

<a href="leaderboard.php" class="nav-link text-white">
        <i class="bi bi-trophy"></i> Leaderboard
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
     MAIN CONTENT
===================================================== -->

<div class="container py-5">


<!-- Welcome -->

<div class="mb-5">


<h1 class="fw-bold">

Welcome back,
<span class="text-primary">

<?php echo htmlspecialchars($_SESSION['user_name']); ?>

</span> 👋

</h1>


<p class="text-muted fs-5 mb-0">

Ready for your next challenge?

</p>


</div>



<!-- =====================================================
     STATISTICS
===================================================== -->

<div class="row g-4 mb-5">


<!-- Attempts -->

<div class="col-md-6 col-lg-3">

<div class="card stats-card p-4 h-100">

<div class="d-flex justify-content-between align-items-center">


<div>

<small class="text-muted">

Total Attempts

</small>

<h2 class="fw-bold mb-0">

<?php echo $total_attempts; ?>

</h2>

</div>


<div class="fs-1">

📝

</div>


</div>

</div>

</div>



<!-- Best Score -->

<div class="col-md-6 col-lg-3">

<div class="card stats-card p-4 h-100">

<div class="d-flex justify-content-between align-items-center">


<div>

<small class="text-muted">

Best Score

</small>

<h2 class="fw-bold mb-0">

<?php echo round($best_score); ?>%

</h2>

</div>


<div class="fs-1">

🏆

</div>


</div>

</div>

</div>



<!-- Average -->

<div class="col-md-6 col-lg-3">

<div class="card stats-card p-4 h-100">

<div class="d-flex justify-content-between align-items-center">


<div>

<small class="text-muted">

Average

</small>

<h2 class="fw-bold mb-0">

<?php echo round($average_score); ?>%

</h2>

</div>


<div class="fs-1">

📊

</div>


</div>

</div>

</div>



<!-- Categories -->

<div class="col-md-6 col-lg-3">

<div class="card stats-card p-4 h-100">

<div class="d-flex justify-content-between align-items-center">


<div>

<small class="text-muted">

Categories

</small>

<h2 class="fw-bold mb-0">

<?php echo $total_categories; ?>

</h2>

</div>


<div class="fs-1">

📚

</div>


</div>

</div>

</div>


</div>



<!-- =====================================================
     AVAILABLE QUIZZES
===================================================== -->

<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h2 class="fw-bold mb-1">

Choose a Quiz

</h2>

<p class="text-muted mb-0">

Select a category and test your knowledge.

</p>

</div>


</div>



<div class="row g-4 mb-5">


<?php

if(mysqli_num_rows($category_query) > 0)

{

    while($category = mysqli_fetch_assoc($category_query))

    {

?>


<div class="col-md-6 col-lg-4">


<div class="card feature-card category-card h-100">


<div class="card-body p-4 d-flex flex-column">


<h3 class="fw-bold">

<?php echo htmlspecialchars($category['category_name']); ?>

</h3>


<p class="text-muted flex-grow-1">

<?php echo htmlspecialchars($category['description']); ?>

</p>


<a
    href="start_quiz.php?category_id=<?php echo $category['id']; ?>"
    class="btn btn-dark feature-btn"
>

Start Quiz

<i class="bi bi-arrow-right ms-1"></i>

</a>


</div>

</div>


</div>


<?php

    }

}

else

{

?>


<div class="col-12">

<div class="alert alert-info">

No quiz categories are currently available.

</div>

</div>


<?php

}

?>


</div>



<!-- =====================================================
     RECENT ACTIVITY
===================================================== -->

<div class="card shadow-sm border-0">


<div class="card-body p-4">


<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h3 class="fw-bold mb-1">

Recent Activity

</h3>

<p class="text-muted mb-0">

Your latest quiz attempts.

</p>

</div>


<a
    href="history.php"
    class="btn btn-outline-dark btn-sm"
>

View All

<i class="bi bi-arrow-right ms-1"></i>

</a>
</div>



<?php if(mysqli_num_rows($recent_query) > 0) { ?>


<div class="table-responsive">


<table class="table align-middle mb-0">


<thead>

<tr>

<th>Category</th>

<th>Score</th>

<th>Percentage</th>

<th>Status</th>

<th>Date</th>

<th></th>

</tr>

</thead>


<tbody>


<?php

while($recent = mysqli_fetch_assoc($recent_query))

{

    if($recent['total_questions'] > 0)
    {
        $percentage =
            ($recent['score'] / $recent['total_questions']) * 100;
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

?>


<tr>


<td>

<strong>

<?php echo htmlspecialchars($recent['category_name']); ?>

</strong>

</td>


<td>

<?php echo $recent['score']; ?>

/

<?php echo $recent['total_questions']; ?>

</td>


<td>

<strong class="text-<?php echo $status_color; ?>">

<?php echo number_format($percentage, 1); ?>%

</strong>

</td>


<td>

<span class="badge bg-<?php echo $status_color; ?>">

<?php echo $status; ?>

</span>

</td>


<td>

<?php

echo date(
    "d M Y",
    strtotime($recent['attempt_date'])
);

?>

</td>


<td class="text-end">


<a
    href="result.php?attempt_id=<?php echo $recent['attempt_id']; ?>"
    class="btn btn-sm btn-outline-dark"
>

<i class="bi bi-bar-chart"></i>

</a>


<a
    href="review.php?attempt_id=<?php echo $recent['attempt_id']; ?>"
    class="btn btn-sm btn-outline-primary"
>

<i class="bi bi-list-check"></i>

</a>


</td>


</tr>


<?php

}

?>


</tbody>

</table>


</div>


<?php } else { ?>


<div class="text-center py-4">


<div class="fs-1 mb-2">

📚

</div>


<h5 class="fw-bold">

No quiz attempts yet

</h5>


<p class="text-muted">

Choose a category above and take your first quiz!

</p>


</div>


<?php } ?>


</div>

</div>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="text-center mt-5 text-secondary">

© <?php echo date("Y"); ?> QuizVerse

</footer>


</div>


</body>

</html>