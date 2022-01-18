<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if($_SESSION["rule"] != 2) header("Location: .");
?>

<html><body>
<?php
 $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251');
 $zapros="UPDATE users SET username='".$_GET['username']."', password='".md5($_GET['password'])."', rule='".$_GET['rule']."' WHERE username='".$_GET['username']."'";
 mysqli_query($conn, $zapros);
 if (mysqli_affected_rows($conn) > 0) {
  echo "Все сохранено. <a href='.'> Вернуться на главную</a>";
 }
 else {
  echo "Ошибка сохранения. <a href='.'> Вернуться на главную </a>";
 }
?>
</body></html>