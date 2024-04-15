<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Login Form</title>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-300">
<div style="padding: 8px; max-width: 320px; width: 100%; background-color: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 12px;">Login</h2>
    <form action="signin_page.php" method="post">
        <div style="margin-bottom: 8px;">
            <label for="email" style="color: #4B5563; font-size: 14px; font-weight: bold; margin-bottom: 4px;">Email</label>
            <input id="email" name="email" type="email" placeholder="Enter your email" style="width: 100%; padding: 8px; border: 1px solid #D1D5DB; border-radius: 4px; outline: none; transition: border-color 0.3s ease-in-out;" />
        </div>
        <div style="margin-bottom: 12px;">
            <label for="password" style="color: #4B5563; font-size: 14px; font-weight: bold; margin-bottom: 4px;">Password</label>
            <input name="password" id="password" type="password" placeholder="Enter your password" style="width: 100%; padding: 8px; border: 1px solid #D1D5DB; border-radius: 4px; outline: none; transition: border-color 0.3s ease-in-out;" />
        </div>
        <button type="submit" name="button_login" style="width: 100%; background-color: #EF4444; margin-top: 8px; color: white; font-weight: bold; padding: 8px; border-radius: 4px; outline: none; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease-in-out;">Sign In</button>
        <button type="submit" name="button_regist" style="width: 100%; background-color: #6366F1; margin-top: 8px; color: white; font-weight: bold; padding: 8px; border-radius: 4px; outline: none; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease-in-out;">Sign Up</button>
    </form>
</div>

  <?php
    $_servername = "localhost";
    $_username = "root";
    $_password = "";
    $_dbname = "btec-student";
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['button_login'])) {

      $email = $_POST['email'];
      $password = $_POST['password'];

      $hash_password = password_hash($password, PASSWORD_DEFAULT);

      // Create a connection
      $conn = new mysqli($_servername, $_username, $_password, $_dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      // Check if the email and password match
      $query = "SELECT * FROM users WHERE email = '$email'";
      $result = $conn->query($query);

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedHash = $row['password'];
        // Verify the password
        if (password_verify($password, $hash_password)) {
          // Password is correct, login successful
          header("Location: students.php");
          exit();
        } else {
          // Password is incorrect, display an error message
          $error = "Invalid email or password";
        }
      } else {
        echo "Fail";

        // Login failed, display an error message
        $error = "Invalid email or password";
      }

      // Close the database connection
      $conn->close();

      // Button 1 is clicked, redirect to page1.php
      // header("Location: page1.php");
      exit(); // Make sure to exit after redirecting
    } elseif (isset($_POST['button_regist'])) {
      // Button 2 is clicked, redirect to page2.php
      header("Location: signup_page.php");
      exit(); // Make sure to exit after redirecting
    }
  }
  ?>
</body>

</html>
