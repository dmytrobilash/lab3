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

$sqlSelect = "SELECT * FROM iteh2lb1var2.groups";
echo "<p><strong> Вывести расписание занятий группы </strong><select id='groups'>";
echo "<option>Группа</option> </p>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo '</select> <input type="submit" value = "ok"onClick=location.href="firstDB.php"><br>';


$sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";
echo "<p><strong>Вывести расписание преподавателя</strong> <select id='teachers'>";
echo "<option>Преподаватели</option></p>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select><input type='submit' value = 'ok'> <br>";

$sqlSelect = "SELECT DISTINCT auditorium FROM iteh2lb1var2.lesson";
echo "<p><strong>Вывести расписание для аудитории</strong> <select id='auditorium'>";
echo "<option>Аудитория</option></p>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[0]);
    echo "</option>";
    
}

echo "</select><input type='submit' value = 'ok'> <br>";
?>


<p><b>Добавление нового ПЗ</b></p>
<div id="div" class="changedP">

<form method="get" action="" id="form">

<p>Введите день недели</p>
<input required name = "day" value="Monday" form="form">
<p>Введите номер пары</p>
<input required name = "number" type="number" value="1" min="1" max="6" step="1" form="form">
<p>Введите номер аудитории</p>
<input required name="aud" value="104i" form="form">
<p>Введите название дисциплины</p>
<input required name="subj" value="Internet Technologies" form="form">
<p><b> Выберите преподавателя<select name = "teacherSelection" form="form"><?php $sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";
echo "<option>Преподаватель</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select>" ?>
 Выберите группу<select name ="groupSelection" form="form"><?php $sqlSelect = "SELECT * FROM iteh2lb1var2.groups";
echo "<option>Группа</option>";
  
foreach($dbh->query($sqlSelect) as $cell)
{   echo "<option>";
    print_r($cell[1]);
    echo "</option>";
}
echo "</select></b></p>" ?>

<input type="submit" value ="Добавить"form="form">

</form>
</div>
<?php
$day = $_GET['day'];
echo($day);
$number=$_GET['number'];
$aud=$_GET['aud'];
$subj=$_GET['subj'];
$teacherSelection=$_GET['teacherSelection'];
$groupSelection=$_GET['groupSelection'];

try {
   
    // Устанавливаем корректную кодировку
    $dbh->exec("set names utf8");
    // Собираем данные для запроса
    $data = array( 'day' => $day, 'number' => $number,
    'aud'=>$aud, 'subj'=>$subj,
    'teacherSelection' => $teacherSelection,
    'groupSelection' => $groupSelection); 
    

    // Подготавливаем SQL-запрос
    //$query = $dbh->prepare("INSERT INTO $db_table (name, text) values (:name, :text)");
    // Выполняем запрос с данными
    //$query->execute($data);
    // Запишим в переменую, что запрос отрабтал
   // $result = true;
} catch (PDOException $e) {
    // Если есть ошибка соединения или выполнения запроса, выводим её
    print "Ошибка!: " . $e->getMessage() . "<br/>";
}

//if ($result) {
  //  echo "Успех. Информация занесена в базу данных";
//}
?>
</body>
</html> 

    


