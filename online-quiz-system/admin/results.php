<?php
include("../includes/admin_auth.php");
include("../includes/db.php");
include("../includes/header.php");

$result = mysqli_query($conn, "
SELECT
quiz_attempts.*,
users.name,
categories.category_name
FROM quiz_attempts
JOIN users ON quiz_attempts.user_id = users.id
JOIN categories ON quiz_attempts.category_id = categories.id
ORDER BY quiz_attempts.id DESC
");
?>

<nav class="navbar navbar-expand-lg shadow" style="background:#1E293B;">
    <div class="container">

        <a class="navbar-brand text-white" href="dashboard.php">
            <span class="d-block fw-bold fs-4 text-white">Admin Panel</span>
            <small style="color:#CBD5E1;">QuizVerse</small>
        </a>

        <a href="logout.php" class="btn btn-outline-light">
            Logout
        </a>

    </div>
</nav>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Quiz Results</h2>

        <a href="dashboard.php" class="btn btn-secondary">
            ← Dashboard
        </a>

    </div>

    <div class="card feature-card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                    <tr>
                        <th>Participant</th>
                        <th>Category</th>
                        <th>Score</th>
                        <th>Total</th>
                        <th>Percentage</th>
                        <th>Date</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php while($row=mysqli_fetch_assoc($result)){ ?>

                    <tr>

                        <td><?php echo $row['name']; ?></td>

                        <td><?php echo $row['category_name']; ?></td>

                        <td>
                            <span class="badge bg-success">
                                <?php echo $row['score']; ?>
                            </span>
                        </td>

                        <td><?php echo $row['total_questions']; ?></td>

                        <td>
                            <?php
                            echo number_format(($row['score']/$row['total_questions'])*100,1);
                            ?>%
                        </td>

                        <td><?php echo $row['attempt_date']; ?></td>

                    </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>