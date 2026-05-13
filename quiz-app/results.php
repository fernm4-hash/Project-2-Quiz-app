<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) {
   header("Location: login.php");
    exit();
}

$numQuestions = $_SESSION["numQuestions"];
$results = $_SESSION["quiz_results"];



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Results Page</title>
   <link rel="stylesheet" href="styles.css">
   <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet'>
</head>
<body>
    <div class = "container">
    <?php
    echo '<p class = "score" >You scored ' . $_SESSION["last_score"] . ' out of ' . $numQuestions . '</p>';

    if($_SESSION["last_percentage"] <=65){
    echo '<p class = "percent" style="color: red;"> ' . $_SESSION["last_percentage"] . '%</p>';
    }
    else{
        echo '<p class = "percent" style="color: green;">' . $_SESSION["last_percentage"] . '%</p>';
    }

    foreach ($results as $key => $value) {
        echo '<div class="question-card">';
    echo "<h2>Question " . ($key + 1) . ": " . $value["question"] . "</h2>";

    if($value["correct"]){
        echo '<p style="color: green;">Your Answer: ' . $value["user_text"] . '</p>';
    } else {
        echo '<p style="color: red;">Your Answer: ' . $value["user_text"] . '</p>';
    }
    echo '<p>Correct Answer: ' . $value["correct_text"] . '</p>';
    echo"</div>";

    }
    ?>
    <a  href="home.php" class = "button">Play Again</a>
</div>
</body>
</html>


