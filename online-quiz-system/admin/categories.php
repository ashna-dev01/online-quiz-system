<?php
include("../includes/admin_auth.php");
include("../includes/db.php");
include("../includes/header.php");
$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizVerse | Categories</title>

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

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            Quiz Categories
        </h2>

        <a href="add_category.php" class="btn btn-success">
            + Add Category
        </a>

    </div>

    <div class="card shadow border-0">

        <div class="card-body">

            <table class="table table-bordered table-hover table-striped align-middle">

                <thead class="table-dark">

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

                <?php while($row=mysqli_fetch_assoc($result)){ ?>

                    <tr>

                        <td><?php echo $row['id']; ?></td>

                        <td><?php echo $row['category_name']; ?></td>

                        <td><?php echo $row['description']; ?></td>

                        <td>

                            <a
                            href="edit_category.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a
                            href="delete_category.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this category?');">

                                Delete

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-4">

        <a href="dashboard.php" class="btn btn-secondary">

            ← Back to Dashboard

        </a>

    </div>

</div>

<?php include("../includes/footer.php"); ?>