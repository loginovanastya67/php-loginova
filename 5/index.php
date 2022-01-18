<?php header('Content-Type: text/html; charset=windows-1251'); ?>

<html>
<body>

<?php
  session_start();

  $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
  mysqli_query($conn, "SET NAMES cp1251");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $query=mysqli_query($conn, "SELECT * FROM users WHERE username='".$_POST["username"]."' AND password='".md5($_POST["password"])."'");
    if($fetch = mysqli_fetch_array($query)) {
      $_SESSION["username"] = $fetch["username"];
      $_SESSION["rule"] = $fetch["rule"];
      if(!$_SESSION["count"]) $_SESSION["count"] = 0;
    }
    else {
      echo "<html><head><title>Авторизация</title></head><body>";
      echo "Неверное имя пользователя или пароль!<br>";
      echo "<br><a href='.'> Вернуться </a>";
    }
  }
  elseif(!$_SESSION["username"]) { 
    echo "<html><head><title>Авторизация</title></head><body>";
    echo "<h1>Логинова А. В.</h1>";
    echo "<form method='post' action='". $PHP_SELF ."'>";
    echo "<p>Пользователь:</p><input type='text' name='username' size='20'>";
    echo "<p>Пароль:</p><input type='password' name='password' size='20'><br><br>";
    echo "<input type='submit' name='submit' value='Войти'></form>";
    echo "<br><a href='..'>Назад</a><br>";
  }
  
  if($_SESSION["username"]) {
    $query=mysqli_query($conn, "SELECT rule FROM users WHERE username='" . $_SESSION["username"] . "'");
    if($fetch = mysqli_fetch_array($query)) $_SESSION["rule"] = $fetch["rule"];

    echo "<html><head><title>База данных</title></head><body>";
    echo "<h2>Языки программирования:</h2>";
    echo "<table border='1'>";
    echo "<tr><th> id </th>";
    echo "<th> Название </th> <th> Тип </th>";
    echo "<th> Год разработки </th> <th> Тип выполнения </th> <th> Разработчик </th>";
    echo "<th> Редактировать </th>";
    if($_SESSION["rule"] == 2) echo "<th>Уничтожить</th>";
    echo "</tr>";
    $result=mysqli_query($conn, "SELECT * FROM pl");
    while ($row=mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["type"] . "</td>";
      echo "<td>" . $row["year"] . "</td>";
      echo "<td>" . $row["exec"] . "</td>";
      echo "<td>" . $row["dev"] . "</td>";
      echo "<td><a href='edit_pl.php?id=" . $row["id"]
      . "'>Редактировать</a></td>";
      if($_SESSION["rule"] == 2) echo "<td><a href='delete_pl.php?id=" . $row["id"]
      . "'>Удалить</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    $num_rows = mysqli_num_rows($result);
    echo "<p> Всего записей: $num_rows </p>";
    echo "<a href='new_pl.php'> Добавить запись </a><br><br>";

    echo "<h2>Разработчики:</h2>";
    echo "<table border='1'>";
    echo "<tr><th> id </th>";
    echo "<th> Название </th> <th> Город </th>";
    echo "<th> Редактировать </th>";
    if($_SESSION["rule"] == 2) echo "<th> Уничтожить </th></tr>";
    $result=mysqli_query($conn, "SELECT * FROM developer");
    while ($row=mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["city"] . "</td>";
      echo "<td><a href='edit_developer.php?id=" . $row["id"]
      . "'>Редактировать</a></td>";
      if($_SESSION["rule"] == 2) echo "<td><a href='delete_developer.php?id=" . $row["id"]
      . "'>Удалить</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    $num_rows = mysqli_num_rows($result);
    echo "<p> Всего записей: $num_rows </p>";
    echo "<a href='new_developer.php'> Добавить запись </a><br><br>";

    echo "<h2>Приложения:</h2>";
    echo "<table border='1'>";
    echo "<tr><th> id </th>";
    echo "<th> id Языка программирования </th> <th> id Разработчика </th>";
    echo "<th> id Дата создания </th> <th> Текущая версия </th>";
    echo "<th> Название </th>";
    echo "<th> Редактировать </th>";
    if($_SESSION["rule"] == 2) echo "<th> Уничтожить </th> </tr>";
    $result=mysqli_query($conn, "SELECT * FROM app");
    while ($row=mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["id_pl"] . "</td>";
      echo "<td>" . $row["id_developer"] . "</td>";
      echo "<td>" . date("d.m.Y", strtotime($row["date"])) . "</td>";
      echo "<td>" . $row["ver"] . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td><a href='edit_app.php?id=" . $row["id"]
      . "'>Редактировать</a></td>";
      if($_SESSION["rule"] == 2) echo "<td><a href='delete_app.php?id=" . $row["id"]
      . "'>Удалить</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    $num_rows = mysqli_num_rows($result);
    echo "<p> Всего записей: $num_rows </p>";
    echo "<a href='new_app.php'> Добавить запись </a><br><br>";

    if($_SESSION["rule"] == 2) {
      echo "<h2>Пользователи:</h2>";
      echo "<table border='1'>";
      echo "<tr><th>Имя пользователя</th><th>Пароль</th><th>Права доступа</th>";
      echo "<th>Редактировать</th><th>Уничтожить</th></tr>";
      $query=mysqli_query($conn, "SELECT * FROM users");
      while($fetch=mysqli_fetch_array($query)) {
        echo "<tr><td>" . $fetch["username"] . "</td>";
        echo "<td>" . $fetch["password"] . "</td>";
        echo "<td>" . $fetch["rule"] . "</td>";
        echo "<td><a href='edit_users.php?username=" . $fetch["username"] . "'>Редактировать</a></td>";
        echo "<td><a href='delete_users.php?username=" . $fetch["username"]. "'>Удалить</a></td></tr>";
      } 
      echo "</table>";
   
      $num_rows = mysqli_num_rows($query);
      echo "<p> Всего записей: $num_rows </p>";
      echo "<a href='new_users.php'>Добавить запись</a><br><br>";
    }

    echo "<br><a href='gen_pdf.php'> Сохранить PDF </a><br>";
    echo "<a href='gen_xls.php'> Сохранить Excel </a><br>";

    $_SESSION["count"]++;
    echo "<br>Подключений за сессию: " . $_SESSION["count"];
    echo "<br><a href='exit.php'>Выход</a><br>";

    echo "<br><a href='..'>Назад</a><br>";

    echo "</body></html>";
 }
?>