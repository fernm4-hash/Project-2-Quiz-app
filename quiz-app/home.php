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
         <p class = "title">Quiz Quest</p>
   
   <h1>Hello <?php echo $_SESSION["username"]; ?></h1>
  <form action = "quiz.php" method = "POST">
   <p>
      <label for="numQuestions">Select Number of Questions</label>
   </p>

   <p>
      <select name="numQuestions" id="numQuestions">
         <option value="5">5</option>
         <option value="10">10</option>
         <option value="15">15</option>
         <option value="20">20</option>
      </select>
</p>

   <p>Click Start to begin the quiz!</p>
   <input type = "submit" value = "Start">
</form>

</div>
</body>
</html>
