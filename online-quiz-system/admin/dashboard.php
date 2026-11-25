<?php

include("../includes/admin_auth.php");
include("../includes/db.php");


// ==================================================
// DASHBOARD STATISTICS
// ==================================================

// Total participants

$totalParticipants = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM users
         WHERE role='participant'"
    )
)['total'];


// Total categories

$totalCategories = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM categories"
    )
)['total'];


// Total questions

$totalQuestions = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM questions"
    )
)['total'];


// Total quiz attempts

$totalAttempts = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM quiz_attempts"
    )
)['total'];


// ==================================================
// OVERALL PERFORMANCE
// ==================================================

$averageResult = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT AVG(
            (score / total_questions) * 100
        ) AS average
        FROM quiz_attempts
        WHERE total_questions > 0"
    )
);

$averageScore = $averageResult['average'] ?? 0;


// ==================================================
// RECENT QUIZ ATTEMPTS
// ==================================================

$recentAttempts = mysqli_query(
    $conn,
    "
    SELECT
        quiz_attempts.id,
        quiz_attempts.score,
        quiz_attempts.total_questions,
        quiz_attempts.attempt_date,
        users.name,
        categories.category_name

    FROM quiz_attempts

    INNER JOIN users
        ON quiz_attempts.user_id = users.id

    INNER JOIN categories
        ON quiz_attempts.category_id = categories.id

    ORDER BY quiz_attempts.attempt_date DESC

    LIMIT 5
    "
);


// ==================================================
// TOP PARTICIPANTS
// ==================================================

$topParticipants = mysqli_query(
    $conn,
    "
    SELECT
        users.id,
        users.name,
        COUNT(quiz_attempts.id) AS attempts,

        AVG(
            (quiz_attempts.score /
            quiz_attempts.total_questions) * 100
        ) AS average_score

    FROM users

    INNER JOIN quiz_attempts
        ON users.id = quiz_attempts.user_id

    WHERE users.role='participant'

    AND quiz_attempts.total_questions > 0

    GROUP BY users.id

    ORDER BY average_score DESC

    LIMIT 5
    "
);


include("../includes/header.php");

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>QuizVerse | Admin Dashboard</title>


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


<!-- ==================================================
     NAVBAR
================================================== -->

<nav
    class="navbar navbar-expand-lg shadow-sm py-3"
    style="background:#111827;"
>

    <div class="container">


        <!-- Brand -->

        <div>

            <h4 class="text-white mb-0 fw-bold">
                QuizVerse
            </h4>

            <small style="color:#94A3B8;">
                Learn • Compete • Grow
            </small>

        </div>


        <!-- Admin -->

        <div class="d-flex align-items-center">

            <span class="text-light me-4">

                <i class="bi bi-person-circle me-1"></i>

                Administrator

            </span>


            <a
                href="logout.php"
                class="btn btn-outline-light rounded-pill px-4"
            >

                <i class="bi bi-box-arrow-right me-1"></i>

                Logout

            </a>

        </div>


    </div>

</nav>



<!-- ==================================================
     WELCOME
================================================== -->

<div class="container mt-5">


    <h1 class="fw-bold mb-2">
        Admin Dashboard
    </h1>


    <p class="text-secondary fs-5 mb-1">

        Welcome back, Administrator 👋

    </p>


    <p class="text-muted">

        Manage quizzes, categories, participants and results
        from one place.

    </p>


</div>



<!-- ==================================================
     STATISTICS
================================================== -->

<div class="container mt-4">


    <div class="row g-4">


        <!-- Participants -->

        <div class="col-lg-3 col-md-6">

            <div class="card stats-card shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">


                        <div>

                            <small class="text-muted">
                                Participants
                            </small>

                            <h2 class="fw-bold mb-0">

                                <?php echo $totalParticipants; ?>

                            </h2>

                        </div>


                        <i class="bi bi-people fs-1 text-primary"></i>


                    </div>

                </div>

            </div>

        </div>



        <!-- Categories -->

        <div class="col-lg-3 col-md-6">

            <div class="card stats-card shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">


                        <div>

                            <small class="text-muted">
                                Categories
                            </small>

                            <h2 class="fw-bold mb-0">

                                <?php echo $totalCategories; ?>

                            </h2>

                        </div>


                        <i class="bi bi-folder2-open fs-1 text-success"></i>


                    </div>

                </div>

            </div>

        </div>



        <!-- Questions -->

        <div class="col-lg-3 col-md-6">

            <div class="card stats-card shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">


                        <div>

                            <small class="text-muted">
                                Questions
                            </small>

                            <h2 class="fw-bold mb-0">

                                <?php echo $totalQuestions; ?>

                            </h2>

                        </div>


                        <i class="bi bi-patch-question fs-1 text-warning"></i>


                    </div>

                </div>

            </div>

        </div>



        <!-- Attempts -->

        <div class="col-lg-3 col-md-6">

            <div class="card stats-card shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">


                        <div>

                            <small class="text-muted">
                                Quiz Attempts
                            </small>

                            <h2 class="fw-bold mb-0">

                                <?php echo $totalAttempts; ?>

                            </h2>

                        </div>


                        <i class="bi bi-bar-chart fs-1 text-danger"></i>


                    </div>

                </div>

            </div>

        </div>


    </div>


</div>



<!-- ==================================================
     OVERALL PERFORMANCE
================================================== -->

<div class="container mt-5">


    <div class="card shadow-sm border-0">

        <div class="card-body p-4">


            <div class="d-flex justify-content-between align-items-center">


                <div>

                    <h4 class="fw-bold mb-1">

                        Overall Quiz Performance

                    </h4>

                    <p class="text-muted mb-0">

                        Average score across all quiz attempts.

                    </p>

                </div>


                <div class="text-end">

                    <div class="display-6 fw-bold text-primary">

                        <?php echo number_format($averageScore, 1); ?>%

                    </div>

                    <small class="text-muted">
                        Average Score
                    </small>

                </div>


            </div>


            <div class="progress mt-4" style="height:10px;">

                <div
                    class="progress-bar"
                    role="progressbar"

                    style="
                        width:
                        <?php echo min(100, max(0, $averageScore)); ?>%;
                    "
                >

                </div>

            </div>


        </div>

    </div>


</div>



<!-- ==================================================
     QUICK ACTIONS
================================================== -->

<div class="container my-5">


    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Quick Actions
            </h3>

            <p class="text-muted mb-0">
                Manage the main areas of QuizVerse.
            </p>

        </div>

    </div>



    <div class="row g-4">


        <!-- Categories -->

        <div class="col-lg-3 col-md-6">

            <div class="card action-card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="fw-bold">

                        <i class="bi bi-folder2-open me-2"></i>

                        Categories

                    </h5>


                    <p class="text-muted">

                        Create and manage quiz categories.

                    </p>


                    <a
                        href="categories.php"
                        class="btn btn-outline-dark w-100"
                    >

                        Manage

                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>



        <!-- Questions -->

        <div class="col-lg-3 col-md-6">

            <div class="card action-card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="fw-bold">

                        <i class="bi bi-patch-question me-2"></i>

                        Questions

                    </h5>


                    <p class="text-muted">

                        Add, edit, import and manage questions.

                    </p>


                    <a
                        href="questions.php"
                        class="btn btn-outline-dark w-100"
                    >

                        Manage

                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>



        <!-- Participants -->

        <div class="col-lg-3 col-md-6">

            <div class="card action-card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="fw-bold">

                        <i class="bi bi-people me-2"></i>

                        Participants

                    </h5>


                    <p class="text-muted">

                        View registered participants.

                    </p>


                    <a
                        href="participants.php"
                        class="btn btn-outline-dark w-100"
                    >

                        Manage

                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>



        <!-- Results -->

        <div class="col-lg-3 col-md-6">

            <div class="card action-card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="fw-bold">

                        <i class="bi bi-bar-chart me-2"></i>

                        Results

                    </h5>


                    <p class="text-muted">

                        View quiz results and scores.

                    </p>


                    <a
                        href="results.php"
                        class="btn btn-outline-dark w-100"
                    >

                        Manage

                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>


    </div>


</div>



<!-- ==================================================
     RECENT QUIZ ATTEMPTS
================================================== -->

<div class="container mb-5">


    <div class="card shadow-sm border-0">


        <div class="card-body">


            <div class="d-flex justify-content-between align-items-center mb-4">


                <div>

                    <h4 class="fw-bold mb-1">

                        Recent Quiz Attempts

                    </h4>

                    <p class="text-muted mb-0">

                        Latest activity from participants.

                    </p>

                </div>


                <a
                    href="results.php"
                    class="btn btn-outline-dark btn-sm"
                >

                    View All

                    <i class="bi bi-arrow-right ms-1"></i>

                </a>


            </div>



            <div class="table-responsive">


                <table class="table align-middle">


                    <thead>

                        <tr>

                            <th>
                                Participant
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Score
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Date
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    if(mysqli_num_rows($recentAttempts) == 0)
                    {

                    ?>

                        <tr>

                            <td
                                colspan="5"
                                class="text-center text-muted py-4"
                            >

                                No quiz attempts yet.

                            </td>

                        </tr>


                    <?php

                    }
                    else
                    {

                        while(
                            $attempt =
                            mysqli_fetch_assoc($recentAttempts)
                        )
                        {

                            $percentage =
                                $attempt['total_questions'] > 0
                                ?
                                (
                                    $attempt['score']
                                    /
                                    $attempt['total_questions']
                                ) * 100
                                :
                                0;

                    ?>


                        <tr>


                            <td class="fw-semibold">

                                <?php

                                echo htmlspecialchars(
                                    $attempt['name']
                                );

                                ?>

                            </td>


                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $attempt['category_name']
                                );

                                ?>

                            </td>


                            <td>

                                <strong>

                                    <?php

                                    echo $attempt['score'];

                                    ?>

                                </strong>

                                /

                                <?php

                                echo $attempt['total_questions'];

                                ?>

                            </td>


                            <td>

                                <?php

                                if($percentage >= 50)
                                {

                                ?>

                                    <span class="badge bg-success">

                                        Passed

                                    </span>

                                <?php

                                }
                                else
                                {

                                ?>

                                    <span class="badge bg-danger">

                                        Failed

                                    </span>

                                <?php

                                }

                                ?>

                            </td>


                            <td class="text-muted">

                                <?php

                                echo date(
                                    "d M Y, h:i A",
                                    strtotime(
                                        $attempt['attempt_date']
                                    )
                                );

                                ?>

                            </td>


                        </tr>


                    <?php

                        }

                    }

                    ?>


                    </tbody>

                </table>

            </div>


        </div>

    </div>


</div>



<!-- ==================================================
     TOP PARTICIPANTS
================================================== -->

<div class="container mb-5">


    <div class="card shadow-sm border-0">


        <div class="card-body">


            <div class="mb-4">

                <h4 class="fw-bold mb-1">

                    Top Participants

                </h4>

                <p class="text-muted mb-0">

                    Participants with the highest average scores.

                </p>

            </div>



            <div class="table-responsive">


                <table class="table align-middle">


                    <thead>

                        <tr>

                            <th>
                                #
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

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    if(mysqli_num_rows($topParticipants) == 0)
                    {

                    ?>

                        <tr>

                            <td
                                colspan="4"
                                class="text-center text-muted py-4"
                            >

                                No participant results yet.

                            </td>

                        </tr>


                    <?php

                    }
                    else
                    {

                        $rank = 1;


                        while(
                            $participant =
                            mysqli_fetch_assoc($topParticipants)
                        )
                        {

                    ?>


                        <tr>


                            <td>

                                <?php

                                if($rank == 1)
                                {

                                    echo "🥇";

                                }
                                elseif($rank == 2)
                                {

                                    echo "🥈";

                                }
                                elseif($rank == 3)
                                {

                                    echo "🥉";

                                }
                                else
                                {

                                    echo $rank;

                                }

                                ?>

                            </td>


                            <td class="fw-semibold">

                                <?php

                                echo htmlspecialchars(
                                    $participant['name']
                                );

                                ?>

                            </td>


                            <td>

                                <?php

                                echo $participant['attempts'];

                                ?>

                            </td>


                            <td>

                                <span class="fw-bold text-primary">

                                    <?php

                                    echo number_format(
                                        $participant['average_score'],
                                        1
                                    );

                                    ?>%

                                </span>

                            </td>


                        </tr>


                    <?php

                            $rank++;

                        }

                    }

                    ?>


                    </tbody>

                </table>

            </div>


        </div>

    </div>


</div>



<!-- ==================================================
     FOOTER
================================================== -->

<?php include("../includes/footer.php"); ?>


</body>

</html>