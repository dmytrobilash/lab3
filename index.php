<!DOCTYPE HTML>
<html>
<head>
<style>
   .changedP p{
       margin: 0;
   }     
</style>
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


//где то тут вывод первой части задания 
$sqlSelect = "SELECT * FROM iteh2lb1var2.groups";
echo '<form method="get" action="firstDB.php">';
echo "<p><strong> Вывести расписание занятий группы </strong><select name='groups'>";
echo "<option name = 'selectiongroup' >Группа</option> </p>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
?>

</select>
    <input type="submit" value = "ok">
</form>


<?php //Где то тут вывод второй части задания БОЖЕ ПОМОГИ МНЕ
$sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";
echo '<form method="get" action="secondDB.php">';
echo "<p><strong>Вывести расписание преподавателя</strong> <select name='teachers'>";
echo "<option>Преподаватели</option></p>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}?>

</select>
    <input type="submit" value = "ok">
</form>


<?php //ВЫВОД ТРЕТЬЕЙ ЧАСТИ 
$sqlSelect = "SELECT DISTINCT auditorium FROM iteh2lb1var2.lesson";
echo '<form method="get" action="thirdDB.php">';
echo "<p><strong>Вывести расписание для аудитории</strong> <select name='auditorium'>";
echo "<option>Аудитория</option></p>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[0]);
    echo "</option>";
    
}
?>
</select>
<input type='submit' value = 'ok'>
</form>


<!-- Добавление нового пз -->

<p><b>Добавление нового ПЗ</b></p>
<div id="div" class="changedP">

<form method="get" action="" id="form">

<p>Введите день недели</p>
<input required name = "week_day" value="Monday">
<p>Введите номер пары</p>
<input required name = "lesson_number" type="number" value="1" min="1" max="6" step="1">
<p>Введите номер аудитории</p>
<input required name="auditorium" value="104i">
<p>Введите название дисциплины</p>
<input required name="disciple" value="AK" >
<p><b> Выберите преподавателя<select name = "name"><?php $sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";
echo "<option>Преподаватель</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}

echo "</select>" ?>
 Выберите группу<select name ="title" ><?php $sqlSelect = "SELECT * FROM iteh2lb1var2.groups";
echo "<option>Группа</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select></b></p>" ?>

<input type="submit" value ="Добавить">

</form>
</div>


<!-- НАЧАЛО ПХП ЛОГИКИ -->
<?php

$week_day = $_GET['week_day'];
$lesson_number=$_GET['lesson_number'];
$auditorium=$_GET['auditorium'];
$disciple=$_GET['disciple'];
$type = 'Practical';
$name=$_GET['name'];
$title=$_GET['title'];

try {
    // Устанавливаем корректную кодировку
    $dbh->exec("set names utf8");
    // Собираем данные для запроса
    
    $alter = "ALTER TABLE $db.lesson CHANGE lesson.ID_Lesson lesson.ID_Lesson INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 1";
    $st= $dbh->prepare($alter);
    $st->execute();

    $sql = "INSERT INTO iteh2lb1var2.lesson (week_day, lesson_number, auditorium, disciple, type) values ( ?, ?, ?, ?, ?)";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$week_day, $lesson_number, $auditorium, $disciple, $type]);
    

    // ВСТАВЛЯЕМ lesson_teacher
    //Получаем айдишник препода
    $sql = $dbh->prepare("SELECT * from $db.teacher where $db.teacher.name = :name");
    $sql->execute(array('name' => $name));
    $sql=$sql->fetch(PDO::FETCH_BOTH);
    $teacher_id = $sql[0];

    //получаем айдишник пары
    $sql = $dbh->prepare("SELECT max(ID_Lesson) from $db.lesson");
    
    $sql->execute(array());
    $sql=$sql->fetch(PDO::FETCH_BOTH);
    $lesson_id = $sql[0];
    
    $sql = "INSERT INTO $db.lesson_teacher (FID_Teacher, FID_Lesson1) values ( ?, ?)";
    $st = $dbh->prepare($sql);
    $st->execute([$teacher_id, $lesson_id]);
    
    // ВСТАВЛЯЕМ lesson_groups
    //получаем айдишник группы
    $sql = $dbh->prepare("SELECT * from $db.groups where $db.groups.title = :title");
    $sql->execute(array('title' => $title));
    $sql=$sql->fetch(PDO::FETCH_BOTH);
    $group_id = $sql[0];

    //получаем айдишник пары
    $sql = $dbh->prepare("SELECT max(ID_Lesson) from $db.lesson");
    
    $sql->execute(array());
    $sql=$sql->fetch(PDO::FETCH_BOTH);
    $lesson_id = $sql[0];

    $sql = "INSERT INTO $db.lesson_groups (FID_Lesson2, FID_Groups) values ( ?, ?)";
    $st = $dbh->prepare($sql);
    $st->execute([$lesson_id, $group_id]);




    $result = true;

} catch (PDOException $e) {
    
    print "Ошибка!: " . $e->getMessage() . "<br/>";
}

if ($result) {
    echo "<p>Успех. Информация занесена в базу данных</p>";
}
?>
</body>
</html> 

    


