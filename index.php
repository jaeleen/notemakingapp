<?php
  session_start();
  if (!isset($_SESSION["user_id"])) {
		header("Location: login.php");
		exit();
	} else {
		$user_id = $_SESSION["user_id"];
		$username = $_SESSION["username"];
    $avatar_URL = $_SESSION["avatar_URL"];
		
		// load the database and get the orders for this user
		$db = new mysqli("localhost", "okon202p", "lovely02", "okon202p");
	  	if ($db->connect_error) {
	  		die ("Connection failed: " . $db->connect_error);
		}
		// ASSIGNMENT 5 SELECT CODE
    // $q = "SELECT Notes.note_id, Notes.title, Notes.created_dt, Notes.last_edit_dt,
    // Roles.role
    // FROM Notes LEFT JOIN Roles ON (Notes.note_id = Roles.note_id)
    // LEFT JOIN Users ON (Roles.user_id = Users.user_id)
    // WHERE Roles.user_id = $user_id AND Roles.role = 'owner' or Roles.role = 'contributor';";
    
    // $result = $db->query($q);

     // Get the notes to which logged in user has access, most recently created first.
     $q = "SELECT DISTINCT Notes.note_id, Notes.title, Notes.created_dt, Notes.last_edit_dt,
     Roles.role, Users.username, Users.avatar_URL
     FROM Notes LEFT JOIN Roles ON (Notes.note_id = Roles.note_id)
     LEFT JOIN Users ON (Roles.user_id = Users.user_id)
     WHERE Roles.user_id = $user_id AND Roles.role = 'owner' or Roles.role = 'contributor' ORDER BY created_dt DESC";
     
     $result = $db->query($q);
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All notes</title>

    <!-- Font awesome link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

    <!-- Style sheet link -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      
      <p class="welcome">
        <span class="wel">Welcome</span
        ><img src="<?=$avatar_URL?>" alt="avatar" class="avatar" /> <?=$username?>
      </p>

      <a class="logout_link" href="logout.php">Logout</a>
      </div>
    

      <h2 class="all-notes">ALL NOTES</h2>
    </header>
   
    <div class="noteslist-container">
    <?php
      // $previous_noteid = "";
      
      while($row = $result->fetch_assoc()){
        ?>
      <div class="notes-container notes-container-secondary">
        <div class="left">
          <div class="avatar-box">
            <img src="<?=$row["avatar_URL"]?>" alt="avatar" class="avatar" />
          </div>
          <div class="avater-text">
            <p class="avatar-name"><?=$row["username"]?></p>
          </div>

          <h3 class="note-topic"><?=$row["title"]?></h3>
          <div class="btn-group">
            <a class="text_link" href="viewnotes.php?nid=<?=$row["note_id"]?>">VIEW</a>

            <a class="text_link" href="access.php?nid=<?=$row["note_id"]?>">SHARE</a>
          </div>
        </div>

        <div class="right">
          <p class="time">Created: <?=$row["created_dt"]?></p>
          <p class="time">Latest post: <?=$row["last_edit_dt"]?></p>
          <!-- <p class="posts">
            <i class="fa-regular fa-pen-to-square"></i> 20 posts
          </p> -->
        </div>
      </div>
      <?php
      }
      $db->close();
      ?>

      <button
        id="newnote-button"
        type="submit"
        onclick="window.location.href='createnote.php';"
      >
        CREATE NEW NOTE
      </button>
    </div>

    <div class="navbar">
      <a href="index.php" class="active"><i class="fas fa-home"></i></a>
      <a href="createnote.php"><i class="fa-solid fa-plus"></i></a>
      <!-- <a href="viewnotes.php"><i class="fa-solid fa-book-open-reader"></i></a>
      <a href="access.html"><i class="fa-solid fa-share"></i></a> -->
    </div>
  </body>
</html>