<?php
session_start();
include("includes/db.php");

$message = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND role='participant'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            header("Location: participant/dashboard.php");
            exit();
        }
        else
        {
            $message = "Incorrect password!";
        }
    }
    else
    {
        $message = "User not found!";
    }
}
?>


<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

<title>QuizVerse | Login</title>

</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            QuizVerse | Learn • Compete • Grow
        </a>
    </div>
</nav>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white text-center">

                    <h3>Participant Login</h3>

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
                                Email Address
                            </label>

                            <input
                            type="email"
                            class="form-control"
                            name="email"
                            required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                            type="password"
                            class="form-control"
                            name="password"
                            required>

                        </div>

                        <div class="d-grid">

                            <input
                            type="submit"
                            name="login"
                            value="Login"
                            class="btn btn-primary btn-lg">

                        </div>

                    </form>

                </div>

                <div class="card-footer text-center">

                    Don't have an account?

                    <a href="register.php">

                        Register Here

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>