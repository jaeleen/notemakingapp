<?php
  session_start();
  if (!isset($_SESSION["user_id"])) {
		header("Location: login.php");
		exit();
	} 
  else {
    $user_id = $_SESSION["user_id"];
		$username = $_SESSION["username"];
    $avatar_URL = $_SESSION["avatar_URL"];

    if(isset($_POST["submitted"]) && $_POST["submitted"]){
      // Get the note topic and check that it isn't empty.
      $noteTopic = trim($_POST["noteTopic"]);

      if(strlen($noteTopic) >0 && strlen($noteTopic) <= 256){
		  
        // load the database and get the orders for this user
	  	  $db = new mysqli("localhost", "okon202p", "lovely02", "okon202p");
	  	  if ($db->connect_error) {
	  		  die ("Connection failed: " . $db->connect_error);
	  	  }	

        // Query to create new note.
        $q = "INSERT INTO Notes (title, created_dt, last_edit_dt) VALUES ('$noteTopic', NOW(), NOW())";

        $r = $db->query($q);

        if($r === true){
          // get id of last inserted note_id and insert into the roles table.
          $last_id = $db->insert_id;

          $q = "INSERT INTO Roles (user_id, role, note_id) VALUES ('$user_id', 'owner', (SELECT note_id FROM Notes WHERE note_id = $last_id))";
          $r = $db->query($q);

          if($r === true){
            header("Location: index.php");
            $db->close();
            exit();
          }
          
        }
        else{
          echo "Data could not be inserted into database.";
        }
      }
      else{
        echo "Note cannot be empty and can only be 256 characters.";
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
    <title>Create note</title>

    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Style sheet link -->
    <link rel="stylesheet" href="style.css"/>
    
    <!-- Javascript link -->
     <script type="text/javascript" src="validate.js"></script>

  </head>
  <body>
    <header>
        <p class="welcome"><span class="wel">Welcome</span> <img src="<?=$avatar_URL?>" alt="avatar" class="avatar"/> <?=$username?></p>
        <a href="index.php">
          <p class="back"><i class="fa-solid fa-angle-left"></i> Notes</p>
        </a>
      </header>

      <div class="createnotes-container">
        <form id="CreateNote" method="post" action="createnote.php">
            <textarea id = "noteTopic" name = "noteTopic" placeholder="NOTE TITLE" ></textarea>
            <p id="charNum"></p>
            <p id="noInput"></p>
            <input type="submit" id="create-button" class="link" value="CREATE NOTE" />
            <input type="hidden" name="submitted" value="1"/>
        </form>
      </div>
      <script type="text/javascript" src="createnote-r.js"></script>

      <div class="navbar">
      <a href="index.php" class="active"><i class="fas fa-home"></i></a>
      <a href="createnote.php"><i class="fa-solid fa-plus"></i></a>
      <!-- <a href="viewnotes.php"><i class="fa-solid fa-book-open-reader"></i></a>
      <a href="access.html"><i class="fa-solid fa-share"></i></a> -->
    </div>

      
  </body>
</html>