<?php
include("../includes/admin_auth.php");
include("../includes/db.php");
include("../includes/header.php");
$result = mysqli_query($conn, "SELECT * FROM users WHERE role='participant' ORDER BY id DESC");
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
    <title>QuizVerse | Participants</title>

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
            Registered Participants
        </h2>

        <a href="dashboard.php" class="btn btn-secondary">
            ← Dashboard
        </a>

    </div>

    <div class="card shadow border-0">

        <div class="card-body">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Registered On</th>

                    </tr>

                </thead>

                <tbody>

                <?php while($row=mysqli_fetch_assoc($result)){ ?>

                    <tr>

                        <td><?php echo $row['id']; ?></td>

                        <td><?php echo $row['name']; ?></td>

                        <td><?php echo $row['email']; ?></td>

                        <td><?php echo $row['created_at']; ?></td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>