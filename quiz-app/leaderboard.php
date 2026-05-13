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
   <title>leaderboard Page</title>
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
   <h1>Leaderboard Page</h1>
   
  
  <?php 
    $stmt = $conn->prepare("SELECT *
                            FROM scores
                            JOIN users on scores.user_id = users.id
                            ORDER BY percentage DESC, score DESC 
                            LIMIT 10");

    $stmt->execute();
    $result = $stmt->get_result();

    $count = 1;

echo "<table border='1'>";

echo "<tr>";
echo "<th>Rank</th>";
echo "<th>Username</th>";
echo "<th>Score</th>";
echo "<th>Percentage</th>";
echo "</tr>";

while ($row = $result->fetch_assoc()) {

    echo "<tr>";

    echo "<td>" . $count . "</td>";

    echo "<td>" . $row["username"] . "</td>";

    echo "<td>" . $row["score"] . "/" . $row["total_questions"] . "</td>";

    echo "<td>" . $row["percentage"] . "%</td>";

    echo "</tr>";

    $count++;
}

echo "</table>";
$stmt->close();

  
  
  
  ?>
   

</div>
</body>
</html>