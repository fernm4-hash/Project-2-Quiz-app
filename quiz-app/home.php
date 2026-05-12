<?php
session_start();

if (!isset($_SESSION["username"])) {
   header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Home Page</title>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
        <nav>
          <ul class = "navbar">
            <li>Quiz App</li>
            <li><a href= "profile.php">Profile</a></li>
            <li><a href= "leaderBoard.php">leader Board</a></li>
            <li><a href= "logout.php">Logout</a></li>
        </ul>
        </nav>
   <h1>Quiz Game</h1>
   <h1>Hello <?php echo $_SESSION["username"]; ?></h1>
   <p>Click Start to begin the quiz!</p>
   <button type = button onclick="window.location.href='quiz.php'">Start</button>
   


</body>
</html>
