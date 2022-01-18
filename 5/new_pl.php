<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<?php
session_start();
if(!$_SESSION["rule"]) header("Location: .");
?>

<html>
<head> <title> Добавление новой записи </title> </head>
<body>
<H2>Добавление новой записи:</H2>
<form action="save_new_pl.php" metod="get">
<br>Название: <input name="name" size="20" type="text">
<br>Тип: <input name="type" size="20" type="text">
<br>Год разработки: <input name="year" size="10" type="text">
<br>Тип выполнения: <input name="exec" size="20" type="text">
<br>Разработчик: <input name="dev" size="20" type="text">
<p><input name="add" type="submit" value="Добавить">
<input name="b2" type="reset" value="Очистить"></p>
</form>
<p><a href="index.php"> Вернуться </a>
</body>
</html>