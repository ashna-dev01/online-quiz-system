<?php

include("../includes/participant_auth.php");
include("../includes/db.php");


// Check if quiz session exists
if(
    !isset($_SESSION['quiz_questions']) ||
    !isset($_SESSION['current_question'])
)
{
    header("Location: dashboard.php");
    exit();
}


// Get current question number
$current = $_SESSION['current_question'];


// Get all selected question IDs
$question_ids = $_SESSION['quiz_questions'];


// Check if quiz is finished
if($current >= count($question_ids))
{
    header("Location: submit_quiz.php");
    exit();
}


// Get current question ID
$question_id = intval($question_ids[$current]);


// Get question from database
$result = mysqli_query(
    $conn,
    "SELECT * FROM questions WHERE id='$question_id'"
);


if(mysqli_num_rows($result) != 1)
{
    die("Question not found.");
}


$row = mysqli_fetch_assoc($result);


// Create options
$options = [
    [
        'value' => 'option1',
        'text' => $row['option1']
    ],
    [
        'value' => 'option2',
        'text' => $row['option2']
    ],
    [
        'value' => 'option3',
        'text' => $row['option3']
    ],
    [
        'value' => 'option4',
        'text' => $row['option4']
    ]
];


// Randomize options
shuffle($options);


// Get previously selected answer
$selected_answer = null;

if(isset($_SESSION['quiz_answers'][$question_id]))
{
    $selected_answer = $_SESSION['quiz_answers'][$question_id];
}


// Number of questions
$total_questions = count($question_ids);


// Question number shown to participant
$question_number = $current + 1;


// Progress percentage
$progress = round(($question_number / $total_questions) * 100);


// ==========================================
// QUIZ TIMER
// ==========================================

if(!isset($_SESSION['quiz_end_time']))
{
    die("Quiz timer was not started. Please start the quiz again.");
}


$remaining_time = $_SESSION['quiz_end_time'] - time();


// If time has expired
if($remaining_time <= 0)
{
    header("Location: submit_quiz.php?timeout=1");
    exit();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Quiz | QuizVerse</title>


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

<nav class="navbar navbar-dark shadow">

    <div class="container">

        <a class="navbar-brand text-white" href="#">

            <span class="d-block fw-bold fs-3">
                QuizVerse
            </span>

            <small style="color:#CBD5E1;">
                Learn • Compete • Grow
            </small>

        </a>

    </div>

</nav>


<!-- Quiz -->
<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">


            <!-- Exit Quiz -->

<div class="d-flex justify-content-end mb-3">

    <a
        href="exit_quiz.php"
        class="btn btn-outline-secondary btn-sm"
        onclick="return confirm('Are you sure you want to exit this quiz? Your current progress will be lost.');"
    >

        <i class="bi bi-box-arrow-left me-1"></i>

        Exit Quiz

    </a>

</div>

<!-- Timer -->

<div class="d-flex justify-content-end mb-3">

    <div
        class="alert alert-warning mb-0 py-2 px-3"
        id="timer"
    >

        <i class="bi bi-clock me-1"></i>

        Time Left:

        <strong id="timer-value">
            <?php echo gmdate("i:s", $remaining_time); ?>
        </strong>

    </div>

</div>



</div>

<!-- Progress -->

<div class="d-flex justify-content-between align-items-center mb-3">

    <span class="fw-semibold">

        Question
        <?php echo $question_number; ?>

        of
        <?php echo $total_questions; ?>

    </span>

    <span class="text-muted">

        <?php echo $progress; ?>%

    </span>

</div>


<div
    class="progress mb-4"
    style="height: 8px;"
>

    <div
        class="progress-bar"
        style="width: <?php echo $progress; ?>%;"
    >
    </div>

</div>


            <!-- Question Card -->

            <div class="card shadow-sm border-0">

                <div class="card-body p-4 p-md-5">


                    <h5 class="fw-bold text-primary mb-4">

                        Question <?php echo $question_number; ?>

                    </h5>


                    <p class="fs-4 fw-semibold mb-4">

                        <?php echo htmlspecialchars($row['question']); ?>

                    </p>


                    <!-- Answer Form -->

                    <form
                        action="next_question.php"
                        method="POST"
                    >


                        <!-- Options -->

                        <?php foreach($options as $option) { ?>

                        <label class="option-card mb-3">


                            <input
                                type="radio"
                                name="answer"
                                value="<?php echo $option['value']; ?>"
                                <?php
                                if($selected_answer === $option['value'])
                                {
                                    echo "checked";
                                }
                                ?>
                                required
                            >


                            <span>

                                <?php echo htmlspecialchars($option['text']); ?>

                            </span>


                        </label>


                        <?php } ?>


                        <!-- Navigation -->

                        <div class="d-flex justify-content-between align-items-center mt-4">


                            <!-- Previous -->

                            <?php if($current > 0) { ?>

<button
    type="submit"
    formaction="previous_question.php"
    formmethod="POST"
    formnovalidate
    class="btn btn-outline-secondary"
>
    <i class="bi bi-arrow-left me-1"></i>
    Previous
</button>

<?php } else { ?>

<div></div>

<?php } ?>


                            <!-- Next / Finish -->

                            <button
                                type="submit"
                                class="btn btn-primary px-4"
                            >

                                <?php if($question_number == $total_questions) { ?>

                                    Finish Quiz

                                    <i class="bi bi-check-circle ms-1"></i>

                                <?php } else { ?>

                                    Next

                                    <i class="bi bi-arrow-right ms-1"></i>

                                <?php } ?>

                            </button>


                        </div>


                    </form>


                </div>

            </div>


        </div>

    </div>


    <footer class="text-center mt-5 text-secondary">

        © <?php echo date("Y"); ?> QuizVerse

    </footer>

</div>

<script>

let remainingTime = <?php echo $remaining_time; ?>;


function updateTimer()
{
    let minutes = Math.floor(remainingTime / 60);

    let seconds = remainingTime % 60;


    minutes = minutes.toString().padStart(2, '0');

    seconds = seconds.toString().padStart(2, '0');


    document.getElementById("timer-value").textContent =
        minutes + ":" + seconds;


    // Time finished
    if(remainingTime <= 0)
    {
        window.location.href = "submit_quiz.php?timeout=1";

        return;
    }


    remainingTime--;
}


// Show immediately
updateTimer();


// Update every second
setInterval(updateTimer, 1000);

</script>
</body>

</html>