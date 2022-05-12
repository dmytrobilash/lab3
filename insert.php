<?php $sqlSelect = "SELECT * FROM iteh2lb1var2.teacher";
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