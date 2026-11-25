<?php

include("../includes/admin_auth.php");
include("../includes/db.php");
include("../includes/header.php");


// --------------------------------------------------
// Get categories
// --------------------------------------------------

$categories = mysqli_query(
    $conn,
    "SELECT * FROM categories ORDER BY category_name"
);


// --------------------------------------------------
// Get selected category
// --------------------------------------------------

$selected_category = isset($_GET['category'])
    ? $_GET['category']
    : "all";


// --------------------------------------------------
// Get search text
// --------------------------------------------------

$search = isset($_GET['search'])
    ? trim($_GET['search'])
    : "";


// Escape search text
$search_safe = mysqli_real_escape_string(
    $conn,
    $search
);


// --------------------------------------------------
// Build question query
// --------------------------------------------------

$sql = "
    SELECT
        questions.*,
        categories.category_name

    FROM questions

    JOIN categories
        ON questions.category_id = categories.id

    WHERE 1=1
";


// --------------------------------------------------
// Category filter
// --------------------------------------------------

if($selected_category != "all")
{
    $category_safe = intval($selected_category);

    $sql .= "
        AND questions.category_id = '$category_safe'
    ";
}


// --------------------------------------------------
// Search filter
// --------------------------------------------------

if($search != "")
{
    $sql .= "
        AND questions.question LIKE '%$search_safe%'
    ";
}


// --------------------------------------------------
// Ordering
// --------------------------------------------------

$sql .= "
    ORDER BY categories.category_name, questions.id
";


// --------------------------------------------------
// Execute query
// --------------------------------------------------

$result = mysqli_query($conn, $sql);


if(!$result)
{
    die("Database Error: " . mysqli_error($conn));
}


// --------------------------------------------------
// Total questions
// --------------------------------------------------

$total_questions = mysqli_num_rows($result);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>QuizVerse | Questions</title>


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


    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Quiz Questions
            </h2>

            <p class="text-muted mb-0">
                Manage, search and organize your quiz questions.
            </p>

        </div>


        <div>

            <a
                href="add_question.php"
                class="btn btn-success"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Add Question

            </a>


            <a
                href="import_questions.php"
                class="btn btn-primary ms-2"
            >

                <i class="bi bi-upload me-1"></i>

                Import CSV

            </a>

        </div>

    </div>



    <!-- Question Count -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="d-flex align-items-center">

                <div
                    class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width:50px;height:50px;"
                >

                    <i class="bi bi-question-circle fs-4"></i>

                </div>


                <div>

                    <small class="text-muted">
                        Questions Found
                    </small>

                    <h4 class="fw-bold mb-0">

                        <?php echo $total_questions; ?>

                    </h4>

                </div>

            </div>

        </div>

    </div>



    <!-- Search and Filter -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <form
                method="GET"
                class="row g-3 align-items-end"
            >


                <!-- Search -->

                <div class="col-md-5">

                    <label class="form-label fw-semibold">

                        Search Question

                    </label>


                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-search"></i>

                        </span>


                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search questions..."
                            value="<?php echo htmlspecialchars($search); ?>"
                        >

                    </div>

                </div>



                <!-- Category -->

                <div class="col-md-4">

                    <label class="form-label fw-semibold">

                        Category

                    </label>


                    <select
                        name="category"
                        class="form-select"
                    >

                        <option value="all">

                            All Categories

                        </option>


                        <?php

                        mysqli_data_seek($categories, 0);

                        while(
                            $cat = mysqli_fetch_assoc($categories)
                        )
                        {

                        ?>

                            <option
                                value="<?php echo $cat['id']; ?>"

                                <?php

                                if(
                                    $selected_category == $cat['id']
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



                <!-- Filter -->

                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-dark w-100"
                    >

                        <i class="bi bi-funnel me-1"></i>

                        Filter

                    </button>

                </div>



                <!-- Clear -->

                <div class="col-md-1">

                    <a
                        href="questions.php"
                        class="btn btn-outline-secondary w-100"
                        title="Clear filters"
                    >

                        <i class="bi bi-x-lg"></i>

                    </a>

                </div>


            </form>

        </div>

    </div>



    <!-- Questions Table -->

    <div class="card shadow border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle mb-0"
                >


                    <thead class="table-dark">

                        <tr>

                            <th
                                class="px-3"
                                width="70"
                            >
                                ID
                            </th>


                            <th width="180">
                                Category
                            </th>


                            <th>
                                Question
                            </th>


                            <th width="130">
                                Correct Answer
                            </th>


                            <th
                                width="170"
                                class="text-center"
                            >
                                Action
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                    <?php

                    if($total_questions == 0)
                    {

                    ?>

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-5"
                            >

                                <i
                                    class="bi bi-search fs-1 text-muted"
                                ></i>


                                <h5 class="mt-3">

                                    No questions found

                                </h5>


                                <p class="text-muted">

                                    Try another search or category.

                                </p>

                            </td>

                        </tr>


                    <?php

                    }
                    else
                    {

                        $currentCategory = "";


                        while(
                            $row = mysqli_fetch_assoc($result)
                        )
                        {


                            // Category heading
                            // Only show when viewing all categories

                            if(
                                $selected_category == "all"
                                &&
                                $currentCategory != $row['category_name']
                            )
                            {

                                $currentCategory =
                                    $row['category_name'];

                    ?>

                                <tr class="table-primary">

                                    <td
                                        colspan="5"
                                        class="fw-bold"
                                    >

                                        <i class="bi bi-folder2-open me-2"></i>

                                        <?php

                                        echo htmlspecialchars(
                                            $currentCategory
                                        );

                                        ?>

                                    </td>

                                </tr>


                    <?php

                            }

                    ?>


                        <!-- Question Row -->

                        <tr>


                            <!-- ID -->

                            <td class="px-3">

                                <?php

                                echo $row['id'];

                                ?>

                            </td>



                            <!-- Category -->

                            <td>

                                <span class="badge bg-secondary">

                                    <?php

                                    echo htmlspecialchars(
                                        $row['category_name']
                                    );

                                    ?>

                                </span>

                            </td>



                            <!-- Question -->

                            <td>

                                <div class="fw-semibold">

                                    <?php

                                    echo htmlspecialchars(
                                        $row['question']
                                    );

                                    ?>

                                </div>


                                <small class="text-muted">

                                    <?php

                                    echo htmlspecialchars(
                                        $row['option1']
                                    );

                                    ?>

                                    |

                                    <?php

                                    echo htmlspecialchars(
                                        $row['option2']
                                    );

                                    ?>

                                    |

                                    <?php

                                    echo htmlspecialchars(
                                        $row['option3']
                                    );

                                    ?>

                                    |

                                    <?php

                                    echo htmlspecialchars(
                                        $row['option4']
                                    );

                                    ?>

                                </small>

                            </td>



                            <!-- Correct Answer -->

                            <td>

                                <span class="badge bg-success">

                                    <?php

                                    echo htmlspecialchars(
                                        $row['correct_answer']
                                    );

                                    ?>

                                </span>

                            </td>



                            <!-- Actions -->

                            <td class="text-center">


                                <!-- Edit -->

                                <a
                                    href="edit_question.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-warning btn-sm"
                                >

                                    <i class="bi bi-pencil"></i>

                                    Edit

                                </a>



                                <!-- Delete -->

                                <a
                                    href="delete_question.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-danger btn-sm"

                                    onclick="
                                        return confirm(
                                            'Are you sure you want to delete this question?'
                                        );
                                    "
                                >

                                    <i class="bi bi-trash"></i>

                                    Delete

                                </a>


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



    <!-- Back -->

    <div class="mt-4">

        <a
            href="dashboard.php"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Back to Dashboard

        </a>

    </div>


</div>


<?php include("../includes/footer.php"); ?>


</body>

</html>