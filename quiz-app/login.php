<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <title>Login Page</title>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
   <h1>Login in Page</h1>
<form action="" method="POST">
   <p>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
   </p>
   <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
   </p>
   <input type="submit">
</form>

   <?php 
	require "db.php";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

   	$email = $_POST["email"];
   	$password = $_POST["password"];
      
      $stmt = $conn->prepare("Select * from users where email = ?");
    	$stmt->bind_param("s", $email);
    	$stmt->execute();
    	$result = $stmt->get_result();
      if ($result->num_rows > 0) {
         $row = $result -> fetch_assoc();
         if(password_verify($password, $row["password"])){
            
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];

            header("Location: home.php");
            exit();
         }
         else{
            echo "<p>Email or password is incorrect!</p>";
         }
        	
    	} else {
         echo "<p>Email or password is incorrect!</p>";
      }

	
	}
	

   ?>

</body>
</html>