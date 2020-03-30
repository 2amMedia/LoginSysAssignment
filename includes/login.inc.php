<?php
// We will be checking whether the user got to this page via the proper method here. 
if (isset($_POST['login-submit'])) {
// The connection script is here so we can close it later. This is to prevent resources from being wasted. 
  require 'dbh.inc.php';
// We will grab all the data from the signup form to use later. 
  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];


  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {

    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
        
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      
      mysqli_stmt_execute($stmt);
     
      $result = mysqli_stmt_get_result($stmt);
   
      if ($row = mysqli_fetch_assoc($result)) {

        $pwdCheck = password_verify($password, $row['pwdUsers']);

        if ($pwdCheck == false) {

          header("Location: ../index.php?error=wrongpwd");
          exit();
        }

        else if ($pwdCheck == true) {
// Here is where we start the session and create the session variables from the user info in the database.
          session_start();
// Session varaibles being pulled from the user data.
          $_SESSION['id'] = $row['idUsers'];
          $_SESSION['uid'] = $row['uidUsers'];
          $_SESSION['email'] = $row['emailUsers'];
// This will register that the user is logged in and take them to the front page. 
          header("Location: ../index.php?login=success");
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
//This is where we close the prepared statement and the connection. 
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
// If the end user accesses this page in an improper way, it will send them back to the signup page. 
  header("Location: ../signup.php");
  exit();
}
