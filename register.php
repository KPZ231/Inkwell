<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Free Markdown Editor - Registration" />
  <link rel="shortcut icon" href="icons/favicon.png" type="image/x-icon">
  <meta name="author" content="KPZ & Hype" />
  <title>Inkwell - Register</title>
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
// Set database connection variables
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'inkwell';

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
  $username = mysqli_real_escape_string($conn, $_POST['username']);

  // Check if user with the same email already exists in the database
  $email_check_query = "SELECT * FROM users WHERE _email='$email' LIMIT 1";
  $username_check_query = "SELECT * FROM users WHERE _name = '$username' LIMIT 1";
  $_email_result = mysqli_query($conn, $email_check_query);
  $_username_result = mysqli_query($conn, $username_check_query);
  $user_email_error = mysqli_fetch_assoc($_email_result);
  $user_username_error = mysqli_fetch_assoc($_username_result);

  if ($user_email_error) {
    echo "<div style='color: red; text-align:center; font-family: monospace; font-size: 2em;'>
    This email is already registered</div>";
  } elseif ($user_username_error) {
    echo "<div style='color: red; text-align:center; font-family: monospace; font-size: 2em;'>
    This username is already being used</div>";
  } else {
    // Insert user data into the database
    $insert_query = "INSERT INTO users (_name, _email, _password) VALUES('$username', '$email', '$password')";
    mysqli_query($conn, $insert_query);

    // Close the database connection
    mysqli_close($conn);
    // Redirect the user to index.html
    header("Location: index.html");
    exit;
  }
  

 
}
?>


<body>
  <h1 style="text-align: center">Inkwell - User Registration</h1>
  <form action="register.php" method="post">
    <label for="email">Email: </label>
    <input type="email" id="email" name="email" required placeholder="Enter Email: "/>
    <label for="username">Username: </label>
    <input type="text" name="username" id="username" placeholder="Enter Username: ">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required  placeholder="Enter Password: "/>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm Password: "/>
    <input class="btn-click" type="submit" value="Register" />
    <div class="error" id="username_error"></div>
    <div class="error" id="password_error"></div>
    <div class="error" id="confirm_password_error"></div>
  </form>

  <button class="return btn-click" onclick="window.location.href = 'index.html';">Return to Home Page</button>
  <script>
    // Add client-side validation
    const form = document.querySelector("form");
    const usernameInput = document.querySelector("#email");
    const passwordInput = document.querySelector("#password");
    const confirmPasswordInput = document.querySelector("#confirm_password");
    const usernameError = document.querySelector("#username_error");
    const passwordError = document.querySelector("#password_error");
    const confirmPasswordError = document.querySelector(
      "#confirm_password_error"
    );

    form.addEventListener("submit", (event) => {
      let isValid = true;

      if (usernameInput.value.trim() === "") {
        isValid = false;
        usernameError.innerHTML = "Username is required";
      } else {
        usernameError.innerHTML = "";
      }

      if (passwordInput.value.trim() === "") {
        isValid = false;
        passwordError.innerHTML = "Password is required";
      } else {
        passwordError.innerHTML = "";
      }

      if (confirmPasswordInput.value.trim() === "") {
        isValid = false;
        confirmPasswordError.innerHTML = "Confirm password is required";
      } else if (confirmPasswordInput.value !== passwordInput.value) {
        isValid = false;
        confirmPasswordError.innerHTML = "Passwords do not match";
      } else {
        confirmPasswordError.innerHTML = "";
      }
      if (!isValid) {
        event.preventDefault();
      }
    });
  </script>

</body>

</html>