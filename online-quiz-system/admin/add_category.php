<?php
include("../includes/admin_auth.php");
include("../includes/db.php");
include("../includes/header.php");
$message = "";
if(!empty($message))
{
    echo '<div class="alert alert-success">'.$message.'</div>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizVerse | Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-light">

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

        <div class="col-lg-7">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    <h3 class="mb-0">
                        Add New Category
                    </h3>

                </div>

                <div class="card-body">

                    <?php if($message!=""){ ?>

                        <div class="alert alert-danger">

                            <?php echo $message; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Category Name
                            </label>

                            <input
                            type="text"
                            name="category_name"
                            class="form-control"
                            placeholder="Enter category name"
                            required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                            placeholder="Enter category description"></textarea>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="categories.php" class="btn btn-secondary">
                                ← Back
                            </a>

                            <input
                            type="submit"
                            name="add"
                            value="Add Category"
                            class="btn btn-success">

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>