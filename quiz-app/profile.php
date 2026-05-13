<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) {
   header("Location: login.php");
    exit();
}
$user_id = $_SESSION["user_id"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Profile Page</title>
   <link rel="stylesheet" href="styles.css">
   <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet'>
</head>
<body>
        <nav>
          <ul class = "navbar">
            
            <li><a href= "home.php">Home</a></li>
            <li><a href= "profile.php">Profile</a></li>
            <li><a href= "leaderboard.php">Leader Board</a></li>
            <li><a href= "logout.php">Logout</a></li>
        </ul>
        </nav>
        <div class = "container">
   <h1 class = "title-page">Profile Page</h1>
   <h1>Hello <?php echo $_SESSION["username"]; ?></h1>
   <h2> Stats: </h2>
  <?php 
  $stmt = $conn->prepare("SELECT 
                            COUNT(*) AS totalQuizzes, 
                            MAX(percentage) AS bestPercentage, 
                            AVG(percentage) AS avgPercentage, 
                            SUM(total_questions) AS totalQuestions, 
                            SUM(score) AS totalScore
                            FROM scores
                            WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    
    while ($row = $result->fetch_assoc()) {

    echo '<div class = "stats">';

    echo '<div class = "stat-card">';
    echo "<h3>Total Quizzes</h3>";
    echo "<p> " . $row["totalQuizzes"] . "</p>";
    echo "</div>";

    echo '<div class = "stat-card">';
    echo "<h3>Best Percentage</h3>";
    echo "<p> " . $row["bestPercentage"] . "%</p>";
    echo "</div>";

    echo '<div class = "stat-card">';
    echo "<h3>Average:</h3>";
    echo "<p> " . round($row["avgPercentage"],2) . "%</p>";
    echo "</div>";

    echo '<div class = "stat-card">';
    echo "<h3>Total Questions Taken:</h3>";
    echo "<p> " . $row["totalQuestions"] . "</p>";
    echo "</div>";

    echo '<div class = "stat-card">';
    echo "<h3>Total Questions Correct:</h3>";
    echo "<p> " . $row["totalScore"] . "</p>";
    echo "</div>";

    echo"</div>";
}


$stmt->close();


    $stmt = $conn->prepare("SELECT id, score, total_questions, percentage, created_at
                            FROM scores
                            WHERE user_id = ?
                            ORDER BY created_at DESC
                            Limit 10");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <p> Last 10 Quizzes</p>
    <?php

echo "<table border='1'>";

echo "<tr>";
echo "<th>Attempt</th>";
echo "<th>Score</th>";
echo "<th>Total Questions</th>";
echo "<th>Percentage</th>";
echo "<th>Date Taken</th>";
echo "</tr>";

while ($row = $result->fetch_assoc()) {

    echo "<tr>";

    echo "<td>" . $row["id"] . "</td>";

    echo "<td>" . $row["score"] . "</td>";

    echo "<td>" . $row["total_questions"] . "</td>";

    echo "<td>" . $row["percentage"] . "%</td>";

    echo "<td>" . $row["created_at"] . "</td>";

    echo "</tr>";
}

echo "</table>";
$stmt->close();

  
  
  
  ?>
   

</div>
</body>
</html>