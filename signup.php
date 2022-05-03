<?php
  session_start();

  $validate = true;
  $error = "";
  $reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
  $reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
  $reg_Uname = "/^[a-zA-Z0-9_-]+$/";
  $email = "";
  $username = "";
  $pswd = "";
  $target_file ="";
  
  
  if (isset($_POST["submitted"]) && $_POST["submitted"]) {
      $email = trim($_POST["email"]);
      $username = trim($_POST["username"]);
      $pswd = trim($_POST["pswd"]);
      $target_dir ='uploads/';
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         
      $db = new mysqli("localhost", "okon202p", "pswd", "okon202p");
      if ($db->connect_error) {
          die ("Connection failed: " . $db->connect_error);
      }
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }

      // Check if file already exists
      if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      }
      else {
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){

          $q2 = "INSERT INTO Users (avatar_URL, email, username, password) VALUES ('$target_file', '$email', '$username', '$pswd')";
           
            $r2 = $db->query($q2);
            
            if ($r2 === true) {
                header("Location: login.php");
                $db->close();
                exit();
            }
            else{
              echo "User could not be added to database.";
            }
        }
        else{
          echo "file upload failed.";
        }
      }
  }
   
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>

    <!-- Style page link -->
    <link rel="stylesheet" href="style.css" />

    <!-- Font awesome link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

    <!-- Javascript link -->
    <script type="text/javascript" src="validate.js"></script>
  </head>

  <body>
    <div class="login-container">
      <div class="login-topic">
        <h2>Sign Up</h2>
        <p class="instructions">
          Fill in this form to Sign Up for your account.
        </p>
      </div>

      <form id="SignUp" method="post" action="signup.php" enctype="multipart/form-data" >
        <div class="login-content">
          <div class="avatar-box">
            <!-- <img
              src="images/stewie-profilepic.png"
              alt="avatar"
              class="avatar"
            /> -->
            <label for="fileToUpload" class="custom-file-upload">
              <i class="fa fa-cloud-upload"></i> Choose Avatar
            </label>
            <input id="fileToUpload" name= "fileToUpload" type="file" />
            <label for="err_msg" id="file_msg" class="err_msg"></label>
          </div>
        </div>
        <div class="login-content">
          <label for="email">Email Address</label>
          <input type="text" id="email" name="email" />
          <label for="err_msg" id="email_msg" class="err_msg"></label>
        </div>

        <div class="login-content">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" />
          <label for="err_msg" id="uname_msg" class="err_msg"></label>
        </div>

        <div class="login-content">
          <label for="pswd">Password</label>
          <input type="password" id="pswd" name="pswd" />
          <label for="err_msg" id="pswd_msg" class="err_msg"></label>
        </div>

        <div class="login-content">
          <label for="pswdr">Confirm Password</label>
          <input type="password" id="pswdr" name="pswdr" />
          <label for="err_msg" id="pswdr_msg" class="err_msg"></label>
        </div>

        <div class="login-content-link">
              <input type="submit" class="link" value="SignUp" />
        </div>
        <input type="hidden" name="submitted" value="1"/>
      </form>

      <script type="text/javascript" src="signup-r.js"></script>

      <div class="login-content bottom">
        <p>Already have an account? <a href="login.php">Log in</a></p>
      </div>
    </div>
  </body>
</html>