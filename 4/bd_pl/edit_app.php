<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<head>
<title> Редактирование данных </title>
</head>
<body>
<?php
 $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251');
 $rows=mysqli_query($conn, "SELECT * FROM app WHERE id=".$_GET['id']);
 while ($st = mysqli_fetch_array($rows)) {
 $id_pl=$st["id_pl"];
 $id_developer=$st["id_developer"];
 $date=$st["date"];
 $ver=$st["ver"];
 $name=$st["name"];
 }

print "<form action='save_edit_app.php' metod='get'>";
print "id Языка программирования: <select name='id_pl'>";
$result=mysqli_query($conn, "SELECT * FROM pl");
echo "<option value='".$id_pl."' selected hidden>".$id_pl."</option>";
foreach($result as $row)
  echo "<option value='".$row["id"]."'>".$row["id"]."</option>";
echo "</select>";
print "<br>id Разработчика: <select name='id_developer'>";
$result=mysqli_query($conn, "SELECT * FROM developer");
echo "<option value='".$id_developer."' selected hidden>".$id_developer."</option>";
foreach($result as $row)
  echo "<option value='".$row["id"]."'>".$row["id"]."</option>";
echo "</select>";
print "<br>Дата создания: <input name='date' type='date'
value='".$date."'>";
print "<br>Текущая версия: <input name='ver' size='20' type='text'
value='".$ver."'>";
print "<br>Название: <input name='name' size='20' type='text'
value='".$name."'>";
print "<input type='hidden' name='id' value='".$_GET['id']."'>";
print "<input type='submit' name='' value='Сохранить'>";
print "</form>";
print "<p><a href=\"index.php\"> Вернуться </a>";
?>
</body>
</html>