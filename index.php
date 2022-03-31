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
<input required name="disciple" >
<p><b> Выберите преподавателя<select name = "teacher"><?php $sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";
echo "<option>Преподаватель</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select>" ?>
 Выберите группу<select name ="groups" ><?php $sqlSelect = "SELECT * FROM iteh2lb1var2.groups";
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
$teacher=$_GET['teacher'];
$groups=$_GET['groups'];

try {
    
    // Устанавливаем корректную кодировку
    $dbh->exec("set names utf8");
    // Собираем данные для запроса
   
    //'teacherSelection' => $teacherSelection,
    //'groupSelection' => $groupSelection
    
    $alter = "ALTER TABLE $db.lesson CHANGE lesson.ID_Lesson lesson.ID_Lesson INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 1";
    $st= $dbh->prepare($alter);
    $st->execute();
    $sql = "INSERT INTO iteh2lb1var2.lesson (week_day, lesson_number, auditorium, disciple, type) values ( ?, ?, ?, ?, ?)";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$week_day, $lesson_number, $auditorium, $disciple, $type]);
    
    // ВСТАВЛЯЕМ lesson_groups
    $sql = "";
    $stmt= $dbh->prepare($sql);
    $stmt->execute();
    
    // ВСТАВЛЯЕМ lesson_teachers
    $sql = "INSERT INTO iteh2lb1var2.lesson_teachers () values ()";
    $stmt= $dbh->prepare($sql);
    $stmt->execute();

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

    


