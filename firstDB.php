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
<h2>Поздравляем, вы попали на вывод базы данных занятий группы</h2>

<?php

$db = "iteh2lb1var2";
$dsn = "mysql:host=localhost";
$user = "root";
$pass = "";
$groups = $_GET['groups'];

$dbh = new PDO($dsn, $user, $pass);
print("Connected to database <br>");


$sqlSelect = $dbh->prepare("SELECT * from $db.groups inner join $db.lesson_groups on $db.groups.ID_Groups = $db.lesson_groups.FID_Groups inner join $db.lesson on $db.lesson_groups.FID_Lesson2=$db.lesson.ID_Lesson where $db.groups.title = :groups");
$sqlSelect->execute(array('groups' => $groups));

//$sqlSelect->bindParam(1, $groups, PDO::PARAM_STR, 10);
//$sqlSelect->execute();


echo "<table border ='1'>";
echo "<tr><th>Group</th><th>Day</th><th>Number</th><th>Auditorium</th><th>Disciple</th><th>Type</th></tr>";
while($cell=$sqlSelect->fetch(PDO::FETCH_BOTH)){
    echo "<tr><td>$cell[1]</td><td>$cell[5]</td><td>$cell[6]</td><td>$cell[7]</td><td>$cell[8]</td><td>$cell[9]</td></tr>";
}
//foreach($dbh->query($sqlSelect) as $cell)
//{   
  //  echo "<tr><td>$cell[1]</td><td>$cell[5]</td><td>$cell[6]</td><td>$cell[7]</td><td>$cell[8]</td><td>$cell[9]</td></tr>";
    
//}
echo "</table>";
?>