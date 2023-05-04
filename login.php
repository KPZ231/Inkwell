<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Free Markdown Editor - Registration" />
  <link rel="shortcut icon" href="icons/favicon.png" type="image/x-icon">
  <meta name="author" content="KPZ & Hype" />
  <title>Inkwell - Sing In</title>
</head>

<style>
  /* Set the background color */
  body {
    background-color: #333333;
    font-family: monospace;
  }

  h1,
  h2,
  h3 {
    color: whitesmoke;
  }

  /* Add styles for the registration form */
  form {
    display: flex;
    flex-direction: column;
    color: whitesmoke;
    width: 400px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 25px;
    background-color: #8020af;
    box-shadow: 10px 10px 5px black;
  }

  /* Add styles for the input fields */
  input[type="email"],
  input[type="text"],
  input[type="password"] {
    font-family: monospace;
    box-shadow: 5px 5px 5px black;
    font-weight: 700;
    width: 95%;
    padding: 10px;
    margin-bottom: 15px;
    border: none;
    border-radius: 10px;
  }

  /* Add styles for the submit button */
  input[type="submit"] {
    font-family: monospace;
    font-size: 1.6em;
    background-color: #c047fc;
    color: whitesmoke;
    padding: 15px;
    box-shadow: 5px 5px 5px black;
    margin-top: 15px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
  }

  /* Add styles for the error messages */
  .error {
    color: #ff0000;
    font-size: 0.8em;
    margin-top: 5px;
  }

  .btn-click {
    background-color: #5d4eaf;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.2s ease;
  }

  .btn-click:active {
    transform: scale(0.95);
  }

  .return {
    border: none;
    background-color: transparent;
    cursor: pointer;
    color: whitesmoke;
    font-family: monospace;
    display: flex;
    flex-direction: column;
    margin: -30px auto;

  }
</style>

<?php
session_start();

// Set database connection variables
$host = 'sql7.freemysqlhosting.net';
$username = 'sql7616083';
$password = 'vjF5EIldlc';
$database = 'sql7616083';


// Connect to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check for connection errors
if (mysqli_connect_errno()) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get user data from POST request
if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Check if user exists in the database
  $login_query = "SELECT * FROM users WHERE _email='$email' AND _password='$password' LIMIT 1";
  $login_result = mysqli_query($conn, $login_query);
  $user = mysqli_fetch_assoc($login_result);

  if ($user) {
    // Store user data in session variables
    $_SESSION['user_id'] = $user['_id'];
    $_SESSION['user_name'] = $user['_name'];
    $_SESSION['user_email'] = $user['_email'];

    // Close the database connection
    mysqli_close($conn);

    // Redirect the user to the home page
    header("Location: index.html");
    exit;
  } else {
    // Display error message if login failed
    echo "<div style='color: red; text-align:center; font-family: monospace; font-size: 2em;'>
    Invalid email or password</div>";
  }
}

// Close the database connection
mysqli_close($conn);
?>



<body>
  <h1 style="text-align: center">Inkwell - User Sing In</h1>
  <form action="login.php" method="post">
    <label for="email">Email: </label>
    <input type="email" id="email" name="email" required placeholder="Enter Email: "/>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required  placeholder="Enter Password: "/>
    <input class="btn-click" type="submit" value="Login" />
    <div class="error" id="username_error"></div>
    <div class="error" id="password_error"></div>
    <div class="error" id="confirm_password_error"></div>
  </form>

  <button class="return btn-click" onclick="window.location.href = 'index.html';">Return to Home Page</button>

</body>
</html>