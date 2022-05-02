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
    // echo $note_id;

    if(isset($_POST["submitted"]) && $_POST["submitted"]){

      // Get the note topic and check that it isn't empty.
      $noteContribution = trim($_POST["noteContribution"]);
      

      if(strlen($noteContribution) >0 && strlen($noteContribution) <= 1500){
        // get note id from previous page(index.html)
        if (isset($_GET['nid'])){
          $note_id = $_GET['nid'];
        }
        // load the database
        $db = new mysqli("localhost", "okon202p", "lovely02", "okon202p");
        if ($db->connect_error) {
          die ("Connection failed: " . $db->connect_error);
        }	

        // Query to create new role.
        $q2 = "INSERT INTO Roles (user_id, role, note_id) VALUES ('$user_id', 'owner', (SELECT note_id FROM Notes WHERE note_id = $note_id));";
        $r2 = $db->query($q2);

        if($r2 === true){
          // get id of last inserted role_id and insert into the contributions table.
          $last_id = $db->insert_id;

          // Query to insert new contribuion into the database.
          $q2 = "INSERT INTO Contributions (role_id, note_id, contribution, save_dt) VALUES ((SELECT role_id FROM Roles WHERE role_id = $last_id), (SELECT note_id FROM Notes WHERE note_id = $note_id), '$noteContribution', NOW())";

          $r2 = $db->query($q2);

          if($r2 === true){
            header("Location: viewnotes.php");
            $db->close();
            exit();
          }
        }
        else{
          echo "Data could not be inserted into database.";
        }
      }
      else{
        echo "Contribution cannot be empty and can only be 1500 characters.";
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
    <title>View and Contribute Note Page</title>

    <!-- Font awesome link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

    <!-- Style sheet link -->
    <link rel="stylesheet" href="style.css" />

     <!-- Javascript link -->
     <script type="text/javascript" src="validate.js"></script>

  </head>
  <body>
    <header>
    <a class="logout_link" href="logout.php">Logout</a>
      <a href="index.php">
        <p class="back"><i class="fa-solid fa-angle-left"></i> Notes</p>
      </a>
      <p class="top-date">Nov 15, 2021 at 5:15pm</p>
    </header>

    <div class="author-profile">
      <div class="avatar-box">
        <img src="images/stewie-profilepic.png" alt="avatar" class="avatar" />
      </div>
      <div class="avater-text">
        <p class="avatar-name"><?= $username ?></p>
      </div>
      <h2 class="note-topic viewnote-topic">Fitness Notes</h2>
    </div>
    <div class="noteslist-container">

      <div class="viewnotes-container">
        <div class="left">
          <div class="avatar-box">
            <img src="#" alt="avatar" class="avatar" />
          </div>
          <div class="avater-text">
            <p class="avatar-name">testing</p>
          </div>

          <p class="chat"> teynr mg jfbjfew njbhrbrj g vbajufur g jwbejebw
          </p>
        </div>

        <div class="right">
          <p class="bottom-date">current date</p>
        </div>
      </div>
    


      <div class="createnotes-container small-createnotes-container">
        <form id="AddNote" method="post" action="viewnotes.php">
          <textarea id="noteContribution" name="noteContribution" placeholder="Notes..."></textarea>
          <p id="numofchars"></p>
          <p id="noInput"></p>
          <input type="submit" id="create-button" class="link" value="CREATE NOTE" />
          <input type="hidden" name="submitted" value="1"/>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="viewnotes-r.js"></script>

    <div class="navbar">
      <a href="index.php" class="active"><i class="fas fa-home"></i></a>
      <a href="createnote.php"><i class="fa-solid fa-plus"></i></a>
      <!-- <a href="viewnotes.php"><i class="fa-solid fa-book-open-reader"></i></a>
      <a href="access.html"><i class="fa-solid fa-share"></i></a> -->
    </div>
  </body>
</html>