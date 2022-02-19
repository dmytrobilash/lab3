
<!DOCTYPE HTML>
<html>
<head>
<title>ЛБ1</title>
</head>
<h2>Лабораторна робота №1, КІУКІ-19-5, Білаш Дмитро, Варіант №1 </h2>

<?php

$db = "iteh2lb1var2";
$dsn = "mysql:host=localhost";
$user = "root";
$pass = "";


$dbh = new PDO($dsn, $user, $pass);
print("Connected to database <br>");

$sqlSelect = "SELECT * FROM iteh2lb1var2.groups";
echo "<select id = 'option_groups'>";
echo "<option>Группа</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select> <br>";

$sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";
echo "<select>";
echo "<option>Преподаватели</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select> <br>";

$sqlSelect = "SELECT DISTINCT auditorium FROM iteh2lb1var2.lesson";
echo "<select>";
echo "<option>Аудитория</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[0]);
    echo "</option>";
}
echo "</select> <br>";
?>
<p>Добавление нового ПЗ</p>
<p>Введите день недели</p>
<input required, value="Monday">
<p>Введите номер пары</p>
<input required, type="number" value="1" min="1" max="6" step="1">
<p>Введите номер аудитории</p>
<input required, value="104i">
<p>Введите название дисциплины</p>
<input required, value="Internet Technologies">
<p> Выберите преподавателя<select><?php $sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";
echo "<option>Преподаватель</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select>" ?>
 Выберите группу<select><?php $sqlSelect = "SELECT * FROM iteh2lb1var2.groups";
echo "<option>Группа</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select>" ?>
</p>

    


