<?php

include("../includes/participant_auth.php");


// Clear the current quiz session
unset($_SESSION['quiz_category']);
unset($_SESSION['quiz_questions']);
unset($_SESSION['current_question']);
unset($_SESSION['quiz_answers']);


// Return to participant dashboard
header("Location: dashboard.php");
exit();

?>