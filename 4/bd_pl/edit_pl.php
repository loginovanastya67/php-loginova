<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<head>
<title> Редактирование данных </title>
</head>
<body>
<?php
 $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, 'SET NAMES cp1251');
 $rows=mysqli_query($conn, "SELECT * FROM pl WHERE id='".$_GET['id']."'");
 while ($st = mysqli_fetch_array($rows)) {
 $id=$st['id'];
 $name=$st['name'];
 $type = $st['type'];
 $year = $st['year'];
 $exec = $st['exec'];
 $dev = $st['dev'];
 }
print "<form action='save_edit_pl.php' metod='get'>";
print "Название: <input name='name' size='20' type='text'
value='".$name."'>";
print "<br>Тип: <input name='type' size='20' type='text'
value='".$type."'>";
print "<br>Год разработки: <input name='year' size='10' type='text'
value='".$year."'>";
print "<br>Тип выполнения: <input name='exec' size='20' type='text'
value='".$exec."'>";
print "<br>Разработчик: <input name='dev' size='20' type='text'
value='".$dev."'>";
print "<input type='hidden' name='id' value='".$id."'> <br>";
print "<input type='submit' name='' value='Сохранить'>";
print "</form>";
print "<p><a href=\"index.php\"> Вернуться </a>";
?>
</body>
</html>