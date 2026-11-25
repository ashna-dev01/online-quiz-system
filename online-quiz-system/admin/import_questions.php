<?php
include("../includes/admin_auth.php");
include("../includes/db.php");

$message = "";

if(isset($_POST['import']))
{
    if(isset($_FILES['csv']) && $_FILES['csv']['error'] == 0)
    {
        $file = fopen($_FILES['csv']['tmp_name'], "r");

        // Skip CSV header
        fgetcsv($file);

        $imported = 0;
        $skipped = 0;

        while(($row = fgetcsv($file, 1000, ",")) !== FALSE)
        {
            $category_id = mysqli_real_escape_string($conn, trim($row[0]));
            $question = mysqli_real_escape_string($conn, trim($row[1]));
            $option1 = mysqli_real_escape_string($conn, trim($row[2]));
            $option2 = mysqli_real_escape_string($conn, trim($row[3]));
            $option3 = mysqli_real_escape_string($conn, trim($row[4]));
            $option4 = mysqli_real_escape_string($conn, trim($row[5]));
            $correct_answer = mysqli_real_escape_string($conn, trim($row[6]));

            // Check whether this exact question already exists
            $check = mysqli_query($conn,
                "SELECT id FROM questions
                 WHERE category_id='$category_id'
                 AND question='$question'"
            );

            if(mysqli_num_rows($check) > 0)
            {
                $skipped++;
                continue;
            }

            mysqli_query($conn,"
                INSERT INTO questions
                (category_id,question,option1,option2,option3,option4,correct_answer)
                VALUES
                ('$category_id','$question','$option1','$option2','$option3','$option4','$correct_answer')
            ");

            $imported++;
        }

        fclose($file);

        $message = "
        Import Completed!<br><br>
        Imported : $imported Questions<br>
        Skipped (Duplicates) : $skipped Questions
        ";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Import Questions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3>Import Questions</h3>

</div>

<div class="card-body">

<?php

if($message!="")
{
    echo "<div class='alert alert-success'>$message</div>";
}

?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">

Choose CSV File

</label>

<input
type="file"
name="csv"
accept=".csv"
class="form-control"
required>

</div>

<input
type="submit"
name="import"
value="Import Questions"
class="btn btn-success">

<a href="dashboard.php" class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>