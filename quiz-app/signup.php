<!DOCTYPE html>
<html lang="en">
<head>
   <title>Signup Page</title>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
   <h1>Sign up Page</h1>
<form action="" method="POST">
   <p>
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required>
   </p>
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

   	$username = $_POST["username"];
   	$email = $_POST["email"];
   	$password = $_POST["password"];

      $stmt = $conn->prepare("Select * from users where email = ?");
    	$stmt->bind_param("s", $email);
    	$stmt->execute();
    	$result = $stmt->get_result();

    	if ($result->num_rows > 0) {
        	echo "<p>Email already registered!</p>";
    	} else {
         $stmt->close();
        	$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        	$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        	$stmt->bind_param("sss", $username, $email, $hashedPassword);

    	if ($stmt->execute()) {
        	echo "<p>Signup successful!</p>";
         header("Location: login.php");
         exit();
    	} else {
        	echo "<p>Error: " . $stmt->error . "</p>";
    	}

    	$stmt->close();
}
   }
	

   ?>

</body>
</html>