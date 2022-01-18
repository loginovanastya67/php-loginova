<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
 session_start();
 if($_SESSION["rule"] == 2) {
  $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
  mysqli_query($conn, 'SET NAMES cp1251');
  $sql_add = "INSERT INTO users SET username='" . $_GET['username']."', password='".md5($_GET['password'])."', rule='".$_GET['rule']. "'";
  mysqli_query($conn, $sql_add);
  if (mysqli_affected_rows($conn)>0) { // если нет ошибок при выполнении запроса
   echo "Запись сохранена.<br>";
   echo "<a href='.'>Вернуться </a>";
  }
  else {
   echo "Ошибка сохранения. <a href='.'>Вернуться </a>";
  }
 }
 else {
  header("Location: .");
 }
?>