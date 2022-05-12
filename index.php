<!DOCTYPE HTML>
<html>

<head>
    <title>ЛБ1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<h2>Лабораторна робота №1, КІУКІ-19-5, Білаш Дмитро, Варіант №1 </h2>
<form method="get" action="firstDB.php">
    <p><strong> Вывести расписание занятий группы </strong><select name='groups'>
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
    <input type="submit" value="ok">
</form>

<form method="get" action="secondDB.php">
    <p><strong>Вывести расписание преподавателя</strong> <select name='teachers'>
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
    <input type="submit" value="ok">
</form>

<form method="get" action="thirdDB.php">
    <p><strong>Вывести расписание для аудитории</strong> <select name='auditorium'>
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
    <input type="submit" value="ok">
</form>


<!-- Добавление нового пз -->

<p><b>Добавление нового ПЗ</b></p>
<div id="div" class="changedP">
    <form method="get" action="" id="form">
        <p>Введите день недели</p>
        <input required name="week_day" value="Monday">
        <p>Введите номер пары</p>
        <input required name="lesson_number" type="number" value="1" min="1" max="6" step="1">
        <p>Введите номер аудитории</p>
        <input required name="auditorium" value="104i">
        <p>Введите название дисциплины</p>
        <input required name="disciple" value="AK">
        <p><b> Выберите преподавателя<select name="name">

                    <?php
                    include "insert.php";
                    ?>
                    <input type="submit" value="Добавить">
    </form>
</div>

<?php
include "insertLogic.php";
?>

<!-- НАЧАЛО ПХП ЛОГИКИ -->

</body>

</html>