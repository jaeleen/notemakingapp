<?php

if (isset($_POST["submitted"]) && $_POST["submitted"]) {
  // get the username and password and check that they aren't empty
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  if (strlen($email) > 0 && strlen($password) > 0) {
    // load the database and verify the username/password
    $db = new mysqli("localhost", "okon202p", "pswd", "okon202p");
      if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
      }
    
      $q = "SELECT user_id, username, avatar_URL FROM Users WHERE email = '$email' AND password = '$password';";
      $result = $db->query($q);
    
      if ($row = $result->fetch_assoc()) {
        // login successful
        session_start();
      $_SESSION["user_id"] = $row["user_id"];
      $_SESSION["username"] = $row["username"];
      $_SESSION["avatar_URL"] = $row["avatar_URL"];
      header("Location: index.php");
      $db->close();
      exit();
    } else {
      // login unsuccessful
      $error = ("The username/password combination was incorrect.");
      $db->close();
    }
  } else {
    $error = ("You must enter a non-blank username/password combination to login.");
  }
} else {
  $error = "";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in</title>


    <!-- fontfamily link -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Style page link -->
    <link rel="stylesheet" href="style.css">

    <!-- Javascript link -->
    <script type="text/javascript" src="validate.js"></script>

  </head>
  <body>
    <div class="login-container">
      <div class="login-topic">
        <h2>Log In</h2>
        <p class="error"><?=$error ?></p>
        <p class="instructions">Fill in this form to Log In to your account.</p>
      </div>

      <form id="LogIn" method="post" action="login.php">
        <div class="login-content-box">
            <div class="login-content">
              <label for="email">Email Address</label>
              <input type="text" id="email" name="email"/>
              <label for="err_msg" id="email_msg" class="err_msg"></label>
            </div>
            
            <div class="login-content">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"/>
              <label for="err_msg" id="pswd_msg" class="err_msg"></label>
            </div>
            
            <div class="login-content-link">
              <input type="submit" class="link" value="LOG IN" />
            </div>
        </div>
        <input type="hidden" name="submitted" value="1"/>
      </form>

     <script type="text/javascript" src="validate-r.js"></script>

      <div class="login-content bottom">
        <p>Do not have an account? <a href="signup.php">Sign up</a></p>
      </div>
      
    </div>
  
  </body>
</html>