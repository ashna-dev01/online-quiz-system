<?php
include("../includes/participant_auth.php");
include("../includes/db.php");

$category_id = $_GET['category_id'];

$result = mysqli_query($conn, "SELECT * FROM questions WHERE category_id='$category_id'");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Start Quiz | QuizVerse</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/style.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg shadow">

<div class="container">

<a class="navbar-brand text-white" href="dashboard.php">
<span class="d-block fw-bold fs-3 text-white">QuizVerse</span>
<small style="display:block;color:#CBD5E1;">
Learn • Compete • Grow
</small>
</a>

<div class="ms-auto">

<a href="../logout.php" class="btn btn-outline-light">
Logout
</a>

</div>

</div>

</nav>

<div class="container py-5">

<div class="text-center mb-5">

<h1 class="fw-bold">
Start Quiz
</h1>

<p class="text-muted fs-5">
Answer every question carefully before submitting.
</p>

</div>

<div class="card feature-card shadow-sm">

<div class="card-body p-4">

<form action="submit_quiz.php" method="POST">

<input
type="hidden"
name="category_id"
value="<?php echo $category_id; ?>">

<?php
$number = 1;

while($row = mysqli_fetch_assoc($result))
{
?>

<div class="card shadow-sm border-0 rounded-4 mb-4">

    <div class="card-body p-4">

        <h5 class="fw-bold text-primary mb-3">
            Question <?php echo $number; ?>
        </h5>

        <p class="fs-5 mb-4">
            <?php echo $row['question']; ?>
        </p>

        <label class="option-card mb-3">

            <input
            type="radio"
            name="answer[<?php echo $row['id']; ?>]"
            value="option1"
            required>

            <span>
                <?php echo $row['option1']; ?>
            </span>

        </label>

        <label class="option-card mb-3">

            <input
            type="radio"
            name="answer[<?php echo $row['id']; ?>]"
            value="option2">

            <span>
                <?php echo $row['option2']; ?>
            </span>

        </label>

        <label class="option-card mb-3">

            <input
            type="radio"
            name="answer[<?php echo $row['id']; ?>]"
            value="option3">

            <span>
                <?php echo $row['option3']; ?>
            </span>

        </label>

        <label class="option-card">

            <input
            type="radio"
            name="answer[<?php echo $row['id']; ?>]"
            value="option4">

            <span>
                <?php echo $row['option4']; ?>
            </span>

        </label>

    </div>

</div>

<?php
$number++;
}
?>

<div class="text-center mt-5">

    <button
    type="submit"
    class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">

        <i class="bi bi-check-circle-fill me-2"></i>

        Submit Quiz

    </button>

</div>

</form>

</div>

</div>

<footer class="text-center mt-5 text-secondary">

© <?php echo date("Y"); ?> QuizVerse

</footer>

</div>

</body>

</html>
