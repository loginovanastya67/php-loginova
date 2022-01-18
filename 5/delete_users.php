<?php
 session_start();
 if($_SESSION["rule"] == 2) {
  $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
  $zapros="DELETE FROM users WHERE username='" . $_GET['username']."'";
  mysqli_query($conn, $zapros);

  if($_GET['username'] == $_SESSION['username']) session_destroy();
 }
 header("Location: .");
?>