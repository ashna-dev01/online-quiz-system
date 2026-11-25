<?php
include("includes/db.php");

$message = "";

if(isset($_POST['register']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $check = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0)
    {
        $message = "Email already exists!";
    }
    else
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(name, email, password, role)
                VALUES('$name', '$email', '$hashedPassword', 'participant')";

        if(mysqli_query($conn, $sql))
        {
            $message = "Registration Successful!";
        }
        else
        {
            $message = "Registration Failed!";
        }
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

<title>QuizVerse | Register</title>
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

                <div class="card-header bg-success text-white text-center">

                    <h3>Participant Registration</h3>

                </div>

                <div class="card-body">

                    <?php if($message!=""){ ?>

                        <div class="alert alert-info">

                            <?php echo $message; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                            type="text"
                            class="form-control"
                            name="name"
                            required>

                        </div>

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
                            name="register"
                            value="Register"
                            class="btn btn-success btn-lg">

                        </div>

                    </form>

                </div>

                <div class="card-footer text-center">

                    Already have an account?

                    <a href="login.php">

                        Login

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>