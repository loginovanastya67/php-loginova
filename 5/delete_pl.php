<?php
session_start();
if($_SESSION["rule"] == 2) {
 $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
 $zapros="DELETE FROM pl WHERE id='" . $_GET['id']."'";
 mysqli_query($conn, $zapros);
}
 header("Location: index.php");
 exit;
?>

