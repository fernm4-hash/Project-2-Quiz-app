<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) {
   header("Location: login.php");
    exit();
}
$filename = "questions.json";
$myfile = fopen($filename, "r");
$contents = fread($myfile, filesize($filename));
$questions = json_decode($contents, true);

if(isset($_POST["numQuestions"])){
    $numQuestions = $_POST["numQuestions"];
    $_SESSION["numQuestions"] = $numQuestions;

    shuffle($questions);
    $randQuestions = array_slice($questions, 0, $numQuestions);

    $_SESSION["quizQuestions"] = $randQuestions;
}

else if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $randQuestions = $_SESSION["quizQuestions"];
    $numQuestions = $_SESSION["numQuestions"];
    $score = 0;
    $results = [];
    
    

    foreach ($randQuestions as $key => $value) {
        $userAnswer = $_POST["Q" . $key] ?? "";
        $question = [];
        $bool = false;  

        if ($userAnswer === $value["answer"]) {
            $score++;
            $bool = true;
        }
        $question = [
            "question" => $value["question"],
            "user_answer" => $userAnswer,
            "correct_answer" => $value["answer"],
            "correct" => $bool,
            "correct_text" => $value[$value["answer"]],
            "user_text" => $userAnswer === "" ? "No answer" : $value[$userAnswer]
        ];
        
        array_push($results,$question);
    }
    $_SESSION["quiz_results"] = $results;
    

    $user_id = $_SESSION["user_id"];
    $percentage = ($score/$numQuestions) * 100;

    $stmt = $conn->prepare("INSERT INTO scores (user_id, score, total_questions, percentage) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiid", $user_id, $score, $numQuestions,$percentage);
    $stmt->execute();
    $stmt->close();

    $_SESSION["last_score"] = $score;
    $_SESSION["last_total"] = $numQuestions;
    $_SESSION["last_percentage"] = $percentage;

    header("Location: results.php");
    exit();

} else {
    header("Location: home.php");
    exit();
}

$randQuestions = $_SESSION["quizQuestions"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Quiz Page</title>
   <link rel="stylesheet" href="styles.css">
   <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet'>
</head>
<body>
    <div class = "container">

    <h1>Quiz</h1>
    
    <form action="" method="POST">
        <?php
foreach ($randQuestions as $key => $value) {
    echo '<div class="question-card">';
    echo "<h2>Question " . ($key + 1) . ": " . $value["question"] . "</h2>";

    echo '<p>';
    echo '<input type="radio" name="Q' . $key . '" id="Q' . $key . 'A" value="A">';
    echo '<label for="Q' . $key . 'A">A. ' . $value["A"] . '</label>';
    echo '</p>';

    echo '<p>';
    echo '<input type="radio" name="Q' . $key . '" id="Q' . $key . 'B" value="B">';
    echo '<label for="Q' . $key . 'B">B. ' . $value["B"] . '</label>';
    echo '</p>';

    echo '<p>';
    echo '<input type="radio" name="Q' . $key . '" id="Q' . $key . 'C" value="C">';
    echo '<label for="Q' . $key . 'C">C. ' . $value["C"] . '</label>';
    echo '</p>';

    echo '<p>';
    echo '<input type="radio" name="Q' . $key . '" id="Q' . $key . 'D" value="D">';
    echo '<label for="Q' . $key . 'D">D. ' . $value["D"] . '</label>';
    echo '</p>';
    echo '</div>';
}
?>

<input type="submit" value="Submit Quiz">

</form>

</div>
</body>
</html>
