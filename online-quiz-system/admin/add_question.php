<?php 
include("../includes/admin_auth.php");
include("../includes/db.php");
include("../includes/header.php");

$message = "";

$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name");

if(isset($_POST['add']))
{
    $category_id = $_POST['category_id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];

    $sql = "INSERT INTO questions
    (category_id, question, option1, option2, option3, option4, correct_answer)
    VALUES
    ('$category_id','$question','$option1','$option2','$option3','$option4','$correct_answer')";

    if(mysqli_query($conn, $sql))
    {
        $message = "Question added successfully!";
    }
    else
    {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">

        <a class="navbar-brand fw-bold" href="dashboard.php">
            Admin Panel
        </a>

        <a href="logout.php" class="btn btn-danger">
            Logout
        </a>

    </div>
</nav>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    <h3 class="mb-0">
                        Add New Question
                    </h3>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Category
                            </label>

                            <select name="category_id" class="form-select">

                                <?php while($cat=mysqli_fetch_assoc($categories)){ ?>

                                <option value="<?php echo $cat['id']; ?>">

                                    <?php echo $cat['category_name']; ?>

                                </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Question
                            </label>

                            <textarea
                            name="question"
                            class="form-control"
                            rows="4"
                            required></textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Option 1
                                </label>

                                <input
                                type="text"
                                name="option1"
                                class="form-control"
                                required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Option 2
                                </label>

                                <input
                                type="text"
                                name="option2"
                                class="form-control"
                                required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Option 3
                                </label>

                                <input
                                type="text"
                                name="option3"
                                class="form-control"
                                required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Option 4
                                </label>

                                <input
                                type="text"
                                name="option4"
                                class="form-control"
                                required>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Correct Answer
                            </label>

                            <select
                            name="correct_answer"
                            class="form-select">

                                <option value="option1">
                                    Option 1
                                </option>

                                <option value="option2">
                                    Option 2
                                </option>

                                <option value="option3">
                                    Option 3
                                </option>

                                <option value="option4">
                                    Option 4
                                </option>

                            </select>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="questions.php" class="btn btn-secondary">

                                ← Back

                            </a>

                            <input
                            type="submit"
                            name="add"
                            value="Add Question"
                            class="btn btn-success">

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>