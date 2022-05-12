<?php
if( isset($_GET['week_day']) && isset($_GET['lesson_number']) && isset($_GET['auditorium']) && isset($_GET['disciple']) && isset($_GET['name']) && isset($_GET['title'])){

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

    echo "Успех. Данные были занесены в БД.";
    
} catch (PDOException $e) {
    
    print "Ошибка!: " . $e->getMessage() . "<br/>";
}
}
?>