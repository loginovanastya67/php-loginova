<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<body>
<?php
 $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
 mysqli_query($conn, "SET NAMES cp1251");
?>
<h2>Языки программирования:</h2>
<table border="1">
<tr>
 <th> id </th>
 <th> Название </th> <th> Тип </th>
 <th> Год разработки </th> <th> Тип выполнения </th> <th> Разработчик </th>
 <th> Редактировать </th> <th> Уничтожить </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM pl"); // запрос на выборку сведений о пользователях
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . $row["name"] . "</td>";
 echo "<td>" . $row["type"] . "</td>";
 echo "<td>" . $row["year"] . "</td>";
 echo "<td>" . $row["exec"] . "</td>";
 echo "<td>" . $row["dev"] . "</td>";
 echo "<td><a href='edit_pl.php?id=" . $row["id"]
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
 echo "<td><a href='delete_pl.php?id=" . $row["id"]
. "'>Удалить</a></td>"; // запуск скрипта для удаления записи
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего записей: $num_rows </p>");
?>
<a href="new_pl.php"> Добавить запись </a><br><br>

<h2>Разработчики:</h2>
<table border='1''>
<tr>
 <th> id </th>
 <th> Название </th> <th> Город </th>
 <th> Редактировать </th> <th> Уничтожить </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM developer"); // запрос на выборку сведений о пользователях
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . $row["name"] . "</td>";
 echo "<td>" . $row["city"] . "</td>";
 echo "<td><a href='edit_developer.php?id=" . $row["id"]
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
 echo "<td><a href='delete_developer.php?id=" . $row["id"]
. "'>Удалить</a></td>"; // запуск скрипта для удаления записи
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего записей: $num_rows </p>");
?>
<a href="new_developer.php"> Добавить запись </a><br><br>

<h2>Приложения:</h2>
<table border='1''>
<tr>
 <th> id </th>
 <th> id Языка программирования </th> <th> id Разработчика </th> <th> Дата создания </th>
 <th> Текущая версия </th> <th> Название </th>
 <th> Редактировать </th> <th> Уничтожить </th> </tr>
<?php
$result=mysqli_query($conn, "SELECT * FROM app"); // запрос на выборку сведений о пользователях
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row["id"] . "</td>";
 echo "<td>" . $row["id_pl"] . "</td>";
 echo "<td>" . $row["id_developer"] . "</td>";
 echo "<td>" . date("d.m.Y", strtotime($row["date"])) . "</td>";
 echo "<td>" . $row["ver"] . "</td>";
 echo "<td>" . $row["name"] . "</td>";
 echo "<td><a href='edit_app.php?id=" . $row["id"]
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
 echo "<td><a href='delete_app.php?id=" . $row["id"]
. "'>Удалить</a></td>"; // запуск скрипта для удаления записи
 echo "</tr>";
}
echo "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего записей: $num_rows </p>");
?>
<a href="new_app.php"> Добавить запись </a><br><br>

<a href="gen_pdf.php"> Сохранить PDF </a><br>
<a href="gen_xls.php"> Сохранить Excel </a><br>

<br><a href='..'>Назад</a><br>

</body> </html>
