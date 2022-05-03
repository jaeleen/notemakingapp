<?php
  session_start();
  if (!isset($_SESSION["user_id"])) {
		header("Location: login.php");
		exit();
	} 
  else {
    $note_id = $_GET["nid"];
    $username = $_SESSION["username"];
    $avatar_URL = $_SESSION["avatar_URL"];

    $db = new mysqli("localhost", "okon202p", "pswd", "okon202p");
	  	if ($db->connect_error) {
	  		die ("Connection failed: " . $db->connect_error);
		}

    $q = "SELECT DISTINCT Users.user_id, Users.username, Users.avatar_URL, Roles.role, Roles.note_id FROM Roles LEFT JOIN Users ON (Roles.user_id = Users.user_id)";
    
    $result = $db->query($q);
  }
  $q2 = "SELECT * FROM Users";
  $r2 = $db->query($q2);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grant and Revoke Access Page</title>

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
        Welcome
        <img src="images/stewie-profilepic.png" alt="avatar" class="avatar" /> <?=$username?>
      </p>
      <a class="logout_link" href="logout.php">Logout</a>

      <a href="index.php">
        <p class="back"><i class="fa-solid fa-angle-left"></i> Notes</p>
      </a>

      <h3 class="note-title note-topic">Fitness Notes</h3>
      <h4 class="all-notes all-users">ALL USERS</h4>
    </header>

    <div class="noteslist-container">
      <div class="allusers-container">
        <?php
        while ($row = $result->fetch_assoc()){
          ?>

        <div class="user">
            <div class="left-side">
              <div class="avatar-box user-avatar">
                <img src="<?=$row["avatar_URL"]?>" alt="avatar" class="avatar" />
              </div>
              <div class="avater-text">
                <p class="avatar-name"><?=$row["username"]?></p>
              </div>
            </div>
            <div class="right-side">
              <form action="access.php" method="post" >
                <input type="hidden" name="user_id" value="<?=$row["user_id"]?>"/>

                <button type="submit" class="access-button">

                  <?php
                  if ($row["note_id"] == $note_id)&&($row["role"] == 'contributor'){

                  }
                  ?>
                
                </button>

                <input type="hidden" name="submitted" value="1"/>
              </form>
              
            </div>
          </div>
          <?php
        }
        $db->close();
        ?>
      </div>
    </div>
    <div class="navbar">
      <a href="index.php" class="active"><i class="fas fa-home"></i></a>
      <a href="createnote.php"><i class="fa-solid fa-plus"></i></a>
      <!-- <a href="viewnotes.php"><i class="fa-solid fa-book-open-reader"></i></a> -->
      <!-- <a href="access.php"><i class="fa-solid fa-share"></i></a> -->
    </div>
  </body>
</html>