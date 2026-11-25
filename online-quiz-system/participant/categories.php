<?php
include("../includes/participant_auth.php");
include("../includes/db.php");
include("../includes/header.php");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Select Quiz Category</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

    <div class="container">

        <a class="navbar-brand fw-bold" href="dashboard.php">
            QuizVerse
        </a>

        <a href="../logout.php" class="btn btn-danger">
            Logout
        </a>

    </div>

</nav>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            Select Quiz Category
        </h2>

        <a href="dashboard.php" class="btn btn-secondary">
            ← Dashboard
        </a>

    </div>

    <div class="card shadow border-0">

        <div class="card-body">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-primary">

                    <tr>

                        <th>ID</th>

                        <th>Category</th>

                        <th>Description</th>

                        <th width="180">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td><?php echo $row['id']; ?></td>

                        <td><?php echo $row['category_name']; ?></td>

                        <td><?php echo $row['description']; ?></td>

                        <td>

                            <a href="start_quiz.php?category_id=<?php echo $row['id']; ?>" class="btn btn-primary">
    Start Quiz
</a>
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>