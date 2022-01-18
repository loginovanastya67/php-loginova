<?php
  header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header("Content-Disposition: attachment; filename=loginova_11.xlsx");

  require "../../vendor/autoload.php";

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  $conn = mysqli_connect("sql11.freemysqlhosting.net","sql11466478","vbqFjsYdN9", "sql11466478") or die ("Невозможно подключиться к серверу");
  mysqli_query($conn, "SET NAMES utf8");

  $spreadsheet = new Spreadsheet();
  
  $sheet = $spreadsheet -> getActiveSheet();

  $sheet -> setTitle("Приложения");

  $sheet -> SetCellValue("A1", "Приложения");
  $sheet -> mergeCells("A1:G1");
  $sheet -> getStyle("A1:G1") -> getAlignment() -> setHorizontal("center");

  $sheet -> getColumnDimension("A") -> setWidth(5);
  $sheet -> getColumnDimension("B") -> setWidth(30);
  $sheet -> getColumnDimension("C") -> setWidth(30);
  $sheet -> getColumnDimension("D") -> setWidth(30);
  $sheet -> getColumnDimension("E") -> setWidth(30);
  $sheet -> getColumnDimension("F") -> setWidth(30);
  $sheet -> getColumnDimension("G") -> setWidth(30);

  $sheet -> SetCellValue("A2", "№");
  $sheet -> SetCellValue("B2", "Название приложения");
  $sheet -> SetCellValue("C2", "Текущая версия");
  $sheet -> SetCellValue("D2", "Название разработчика");
  $sheet -> SetCellValue("E2", "Город");
  $sheet -> SetCellValue("F2", "Тип выполнения");
  $sheet -> SetCellValue("G2", "Тип (комп. / интер.)");

  $query_app = mysqli_query($conn, "SELECT * FROM app");
  for($i = 1; $fetch_app = mysqli_fetch_array($query_app); $i++) {
    $name_app = $fetch_app["name"];
    $ver = $fetch_app["ver"];
    $id_pl = $fetch_app["id_pl"];
    $id_developer = $fetch_app["id_developer"];

    $query_developer = mysqli_query($conn, "SELECT * FROM developer WHERE id = '" . $id_developer . "'");
    if($fetch_developer = mysqli_fetch_array($query_developer)) {
      $name_developer = $fetch_developer["name"];
      $city = $fetch_developer["city"];
    }
   
    $query_pl = mysqli_query($conn, "SELECT * FROM pl WHERE id = '" . $id_pl . "'");
    if($fetch_pl = mysqli_fetch_array($query_pl)) {
      $name_pl = $fetch_pl["name"];
      $exec = $fetch_pl["exec"];
      $type = $fetch_pl["type"];
    }

    $sheet -> SetCellValue("A".($i+2), $i);
    $sheet -> SetCellValue("B".($i+2), $name_app);
    $sheet -> SetCellValue("C".($i+2), $ver);
    $sheet -> SetCellValue("D".($i+2), $name_developer);
    $sheet -> SetCellValue("E".($i+2), $city);
    $sheet -> SetCellValue("F".($i+2), $exec);
    $sheet -> SetCellValue("G".($i+2), $type);
  }

  $writer = new Xlsx($spreadsheet);
  $writer -> save("php://output");

  exit();
  
?>
