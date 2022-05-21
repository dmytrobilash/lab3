<!DOCTYPE HTML>
<html>

<head>
    <title>ЛБ1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>

</head>
<h2>Лабораторна робота №1, КІУКІ-19-5, Білаш Дмитро, Варіант №1 </h2>
<!--<form method="get" action="firstDB.php">-->
<p><strong> Вывести расписание занятий группы </strong><select name="groups" id="groups">
        <option name='selectiongroup'>Группа</option>
</p>

<?php
include "connection.php";
//где то тут вывод первой части задания 
$sqlSelect = "SELECT * FROM iteh2lb1var2.groups";
foreach ($dbh->query($sqlSelect) as $cell) {
    echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
?>
</select>
<input type="submit" value="ok" onclick="ok1()">
<!--</form> -->

<!--<form method="get" action="secondDB.php">-->
<p><strong>Вывести расписание преподавателя</strong> <select name="teachers" id="teachers">
        <option>Преподаватели</option>
</p>

<?php
$sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";

foreach ($dbh->query($sqlSelect) as $cell) {
    echo "<option>";
    print_r($cell[1]);
    echo "</option>";
} ?>

</select>
<input type="submit" value="ok" onclick="ok2()">
<!--</form>-->

<!-- <form method="get" action="thirdDB.php"> -->
<p><strong>Вывести расписание для аудитории</strong> <select name="auditorium" id="auditorium">
        <option>Аудитория</option>
</p>
<?php
$sqlSelect = "SELECT DISTINCT auditorium FROM iteh2lb1var2.lesson";


foreach ($dbh->query($sqlSelect) as $cell) {
    echo "<option>";
    print_r($cell[0]);
    echo "</option>";
}
?>
</select>
<input type="submit" value="ok" onclick="ok3()">
<table border='1'>
    <thead>
        <tr>
            <th>Group</th>
            <th>Day</th>
            <th>Number</th>
            <th>Auditorium</th>
            <th>Disciple</th>
            <th>Type</th>
        </tr>
    </thead>
    <tbody id="result">

    </tbody>
</table>
</body>

</html>