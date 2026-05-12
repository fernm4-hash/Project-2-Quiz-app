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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $randQuestions = $_SESSION["quizQuestions"];
    $score = 0;

    foreach ($randQuestions as $key => $value) {
        $userAnswer = $_POST["Q" . $key] ?? "";

        if ($userAnswer === $value["answer"]) {
            $score++;
        }
    }
    echo "<p>You scored $score out of 10</p>";

    $user_id = $_SESSION["user_id"];
    $numQuestions = 10;
    $percentage = ($score/$numQuestions) * 100;

    $stmt = $conn->prepare("INSERT INTO scores (user_id, score, total_questions, percentage) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiid", $user_id, $score, $numQuestions,$percentage);
    $stmt->execute();
    $stmt->close();



} else {
    shuffle($questions);
    $randQuestions = array_slice($questions, 0, 10);
    $_SESSION["quizQuestions"] = $randQuestions;
}



echo "<form action='' method='POST'>";
foreach ($randQuestions as $key => $value) {
   echo "<h2>" . $value["question"] . "</h2>";

echo '<p>';
echo '<input type="radio" name="Q' . $key .'" id="Q' . $key . 'A" value="A">';
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
}
echo '<input type = "submit" value = "Submit Quiz">';
echo "</form>";


fclose($myfile);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Quiz Page</title>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
</body>
</html>
