<?php

include("../includes/admin_auth.php");
include("../includes/db.php");


// --------------------------------------------------
// Check question ID
// --------------------------------------------------

if(!isset($_GET['id']))
{
    header("Location: questions.php");
    exit();
}

$id = intval($_GET['id']);


// --------------------------------------------------
// Get question
// --------------------------------------------------

$result = mysqli_query(
    $conn,
    "SELECT * FROM questions WHERE id='$id'"
);

if(mysqli_num_rows($result) != 1)
{
    die("Question not found.");
}

$row = mysqli_fetch_assoc($result);


// --------------------------------------------------
// Get categories
// --------------------------------------------------

$categories = mysqli_query(
    $conn,
    "SELECT * FROM categories ORDER BY category_name"
);


// --------------------------------------------------
// Update question
// --------------------------------------------------

if(isset($_POST['update']))
{

    $category_id = intval($_POST['category_id']);

    $question = mysqli_real_escape_string(
        $conn,
        trim($_POST['question'])
    );

    $option1 = mysqli_real_escape_string(
        $conn,
        trim($_POST['option1'])
    );

    $option2 = mysqli_real_escape_string(
        $conn,
        trim($_POST['option2'])
    );

    $option3 = mysqli_real_escape_string(
        $conn,
        trim($_POST['option3'])
    );

    $option4 = mysqli_real_escape_string(
        $conn,
        trim($_POST['option4'])
    );

    $correct_answer = mysqli_real_escape_string(
        $conn,
        $_POST['correct_answer']
    );


    // --------------------------------------------------
    // Validate correct answer
    // --------------------------------------------------

    $valid_answers = [
        "option1",
        "option2",
        "option3",
        "option4"
    ];

    if(!in_array($correct_answer, $valid_answers))
    {
        die("Invalid correct answer.");
    }


    // --------------------------------------------------
    // Update database
    // --------------------------------------------------

    $update = mysqli_query(
        $conn,
        "
        UPDATE questions
        SET
            category_id='$category_id',
            question='$question',
            option1='$option1',
            option2='$option2',
            option3='$option3',
            option4='$option4',
            correct_answer='$correct_answer'
        WHERE id='$id'
        "
    );


    if($update)
    {
        header("Location: questions.php?updated=1");
        exit();
    }
    else
    {
        die(
            "Error updating question: "
            . mysqli_error($conn)
        );
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

<title>QuizVerse | Edit Question</title>


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


<!-- Admin Navbar -->

<nav class="navbar navbar-dark bg-dark shadow">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="dashboard.php"
        >
            Admin Panel
        </a>


        <a
            href="logout.php"
            class="btn btn-danger"
        >
            Logout
        </a>

    </div>

</nav>



<!-- Main Container -->

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">


            <!-- Edit Card -->

            <div class="card shadow border-0">


                <!-- Header -->

                <div class="card-header bg-warning">

                    <h3 class="mb-0 text-dark">

                        <i class="bi bi-pencil-square me-2"></i>

                        Edit Question

                    </h3>

                </div>



                <!-- Body -->

                <div class="card-body p-4">


                    <form method="POST">


                        <!-- Category -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Category

                            </label>


                            <select
                                name="category_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Select Category
                                </option>


                                <?php

                                while(
                                    $cat =
                                    mysqli_fetch_assoc($categories)
                                )
                                {

                                ?>

                                <option
                                    value="<?php echo $cat['id']; ?>"
                                    <?php

                                    if(
                                        $cat['id'] ==
                                        $row['category_id']
                                    )
                                    {
                                        echo "selected";
                                    }

                                    ?>
                                >

                                    <?php

                                    echo htmlspecialchars(
                                        $cat['category_name']
                                    );

                                    ?>

                                </option>

                                <?php

                                }

                                ?>

                            </select>

                        </div>



                        <!-- Question -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Question

                            </label>


                            <textarea
                                name="question"
                                class="form-control"
                                rows="4"
                                required
                            ><?php

                            echo htmlspecialchars(
                                $row['question']
                            );

                            ?></textarea>

                        </div>



                        <!-- Options -->

                        <div class="row">


                            <!-- Option 1 -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Option 1

                                </label>


                                <input
                                    type="text"
                                    name="option1"
                                    class="form-control"
                                    value="<?php

                                    echo htmlspecialchars(
                                        $row['option1']
                                    );

                                    ?>"
                                    required
                                >

                            </div>



                            <!-- Option 2 -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Option 2

                                </label>


                                <input
                                    type="text"
                                    name="option2"
                                    class="form-control"
                                    value="<?php

                                    echo htmlspecialchars(
                                        $row['option2']
                                    );

                                    ?>"
                                    required
                                >

                            </div>



                            <!-- Option 3 -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Option 3

                                </label>


                                <input
                                    type="text"
                                    name="option3"
                                    class="form-control"
                                    value="<?php

                                    echo htmlspecialchars(
                                        $row['option3']
                                    );

                                    ?>"
                                    required
                                >

                            </div>



                            <!-- Option 4 -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Option 4

                                </label>


                                <input
                                    type="text"
                                    name="option4"
                                    class="form-control"
                                    value="<?php

                                    echo htmlspecialchars(
                                        $row['option4']
                                    );

                                    ?>"
                                    required
                                >

                            </div>


                        </div>



                        <!-- Correct Answer -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Correct Answer

                            </label>


                            <select
                                name="correct_answer"
                                class="form-select"
                                required
                            >

                                <option
                                    value="option1"
                                    <?php

                                    if(
                                        $row['correct_answer']
                                        == "option1"
                                    )
                                    {
                                        echo "selected";
                                    }

                                    ?>
                                >
                                    Option 1
                                </option>


                                <option
                                    value="option2"
                                    <?php

                                    if(
                                        $row['correct_answer']
                                        == "option2"
                                    )
                                    {
                                        echo "selected";
                                    }

                                    ?>
                                >
                                    Option 2
                                </option>


                                <option
                                    value="option3"
                                    <?php

                                    if(
                                        $row['correct_answer']
                                        == "option3"
                                    )
                                    {
                                        echo "selected";
                                    }

                                    ?>
                                >
                                    Option 3
                                </option>


                                <option
                                    value="option4"
                                    <?php

                                    if(
                                        $row['correct_answer']
                                        == "option4"
                                    )
                                    {
                                        echo "selected";
                                    }

                                    ?>
                                >
                                    Option 4
                                </option>

                            </select>

                        </div>



                        <!-- Buttons -->

                        <div class="d-flex justify-content-between">

                            <a
                                href="questions.php"
                                class="btn btn-secondary"
                            >

                                <i class="bi bi-arrow-left me-1"></i>

                                Back

                            </a>


                            <button
                                type="submit"
                                name="update"
                                class="btn btn-warning"
                            >

                                <i class="bi bi-check-circle me-1"></i>

                                Update Question

                            </button>

                        </div>


                    </form>


                </div>

            </div>

        </div>

    </div>

</div>



<?php include("../includes/footer.php"); ?>


</body>

</html>