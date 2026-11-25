<?php

include("../includes/participant_auth.php");
include("../includes/db.php");


$user_id = $_SESSION['user_id'];


// =====================================================
// CATEGORY FILTER
// =====================================================

$selected_category = 0;

if(isset($_GET['category_id']))
{
    $selected_category = intval($_GET['category_id']);
}


// =====================================================
// GET CATEGORIES
// =====================================================

$categories_query = mysqli_query(
    $conn,
    "SELECT id, category_name
     FROM categories
     ORDER BY category_name ASC"
);


// =====================================================
// LEADERBOARD QUERY
// =====================================================

if($selected_category > 0)
{

    $leaderboard_query = mysqli_query(
        $conn,
        "
        SELECT
            users.id AS user_id,
            users.name,

            COUNT(quiz_attempts.id) AS attempts,

            AVG(
                quiz_attempts.score /
                NULLIF(quiz_attempts.total_questions, 0) * 100
            ) AS average_score,

            MAX(
                quiz_attempts.score /
                NULLIF(quiz_attempts.total_questions, 0) * 100
            ) AS best_score

        FROM users

        INNER JOIN quiz_attempts
            ON users.id = quiz_attempts.user_id

        WHERE
            users.role = 'participant'
            AND quiz_attempts.category_id = '$selected_category'

        GROUP BY users.id

        HAVING attempts >= 3

        ORDER BY
            average_score DESC,
            best_score DESC,
            attempts DESC
        "
    );

}
else
{

    $leaderboard_query = mysqli_query(
        $conn,
        "
        SELECT
            users.id AS user_id,
            users.name,

            COUNT(quiz_attempts.id) AS attempts,

            AVG(
                quiz_attempts.score /
                NULLIF(quiz_attempts.total_questions, 0) * 100
            ) AS average_score,

            MAX(
                quiz_attempts.score /
                NULLIF(quiz_attempts.total_questions, 0) * 100
            ) AS best_score

        FROM users

        INNER JOIN quiz_attempts
            ON users.id = quiz_attempts.user_id

        WHERE
            users.role = 'participant'

        GROUP BY users.id

        HAVING attempts >= 3

        ORDER BY
            average_score DESC,
            best_score DESC,
            attempts DESC
        "
    );

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

<title>Leaderboard | QuizVerse</title>


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
    href="dashboard.php"
    class="nav-link text-white"
>

<i class="bi bi-house-door me-1"></i>

Home

</a>


<a
    href="history.php"
    class="nav-link text-white"
>

<i class="bi bi-clock-history me-1"></i>

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


<!-- Header -->

<div class="text-center mb-5">


<div class="display-3 mb-2">

🏆

</div>


<h1 class="fw-bold">

Leaderboard

</h1>


<p class="text-muted fs-5">

Compete with other participants and see where you rank.

</p>


</div>



<!-- =====================================================
     FILTER
===================================================== -->

<div class="card shadow-sm border-0 mb-4">


<div class="card-body p-4">


<div class="row align-items-center">


<div class="col-md-6">


<h5 class="fw-bold mb-1">

Leaderboard

</h5>


<p class="text-muted mb-md-0">

Ranking is based on average quiz percentage.

</p>


</div>


<div class="col-md-6">


<form
    method="GET"
    action="leaderboard.php"
>


<label class="form-label fw-semibold">

Choose Category

</label>


<select
    name="category_id"
    class="form-select"
    onchange="this.form.submit()"
>


<option value="0">

🏆 Overall Leaderboard

</option>


<?php

while($category = mysqli_fetch_assoc($categories_query))

{

?>


<option
    value="<?php echo $category['id']; ?>"
    <?php

    if($selected_category == $category['id'])
    {
        echo "selected";
    }

    ?>
>

<?php echo htmlspecialchars($category['category_name']); ?>

</option>


<?php

}

?>


</select>


</form>


</div>


</div>


</div>

</div>



<!-- =====================================================
     MINIMUM ATTEMPTS INFO
===================================================== -->

<div class="alert alert-info border-0 shadow-sm">


<i class="bi bi-info-circle me-2"></i>


Only participants with at least

<strong>3 quiz attempts</strong>

are included in the leaderboard.

</div>



<!-- =====================================================
     LEADERBOARD TABLE
===================================================== -->

<div class="card shadow-sm border-0">


<div class="card-body p-0">


<div class="table-responsive">


<table class="table table-hover align-middle mb-0">


<thead class="table-light">


<tr>


<th class="ps-4">

Rank

</th>


<th>

Participant

</th>


<th>

Attempts

</th>


<th>

Average Score

</th>


<th>

Best Score

</th>


</tr>


</thead>


<tbody>


<?php


$rank = 1;

$found_participant = false;


if(mysqli_num_rows($leaderboard_query) > 0)

{


while($leader = mysqli_fetch_assoc($leaderboard_query))

{


$average = round(
    $leader['average_score'],
    1
);


$best = round(
    $leader['best_score'],
    1
);


// Check current participant

$is_me =
    ($leader['user_id'] == $user_id);


if($is_me)
{
    $found_participant = true;
}


// Medal

if($rank == 1)
{
    $rank_display = "🥇";
}
elseif($rank == 2)
{
    $rank_display = "🥈";
}
elseif($rank == 3)
{
    $rank_display = "🥉";
}
else
{
    $rank_display = $rank;
}

?>


<tr
<?php

if($is_me)
{
    echo 'class="table-primary"';
}

?>
>


<td class="ps-4 fw-bold">


<span class="fs-5">

<?php echo $rank_display; ?>

</span>


</td>


<td>


<div class="d-flex align-items-center gap-2">



<div class="leaderboard-avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center">

<i class="bi bi-person-fill"></i>


</div>


<div>


<strong>

<?php echo htmlspecialchars($leader['name']); ?>

</strong>


<?php if($is_me) { ?>


<span class="badge bg-primary ms-2">

You

</span>


<?php } ?>


</div>


</div>


</td>


<td>


<?php echo $leader['attempts']; ?>

</td>


<td>


<strong class="text-primary">

<?php echo number_format($average, 1); ?>%

</strong>


</td>


<td>


<strong class="text-success">

<?php echo number_format($best, 1); ?>%

</strong>


</td>


</tr>


<?php


$rank++;


}


}

else

{


?>


<tr>


<td
    colspan="5"
    class="text-center py-5"
>


<div class="fs-1 mb-3">

📚

</div>


<h5 class="fw-bold">

No rankings available yet

</h5>


<p class="text-muted mb-0">

Participants need at least 3 quiz attempts to appear here.

</p>


</td>


</tr>


<?php

}

?>


</tbody>


</table>


</div>


</div>

</div>



<?php if($found_participant) { ?>


<div class="text-center mt-4">


<p class="text-muted">

Keep practicing and improve your average score to climb the leaderboard! 🚀

</p>


</div>


<?php } ?>



<!-- Back -->

<div class="text-center mt-4">


<a
    href="dashboard.php"
    class="btn btn-dark px-4"
>

<i class="bi bi-arrow-left me-1"></i>

Back to Dashboard

</a>


</div>



<!-- Footer -->

<footer class="text-center mt-5 text-secondary">

© <?php echo date("Y"); ?> QuizVerse

</footer>


</div>


</body>

</html>