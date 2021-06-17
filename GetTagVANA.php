<?php


require("db.php");
require("config.php");
//$sql = "SELECT firstname, lastname FROM student JOIN tag ON student.student_id = tag.tag_id JOIN student_tag ON student_tag.student_student_id = tag.tag_id";
//$sql =  "SELECT student.firstname, student.lastname, student_id, student_tag.student_student_id, student_tag.tag_tag_id FROM ";
$otsing='';
if(isset($_REQUEST["otsing"])){
    $otsing=$_REQUEST["otsing"];
}

$sql = "SELECT student.firstname, student.lastname, GROUP_CONCAT(CONCAT(tag.tag_color, '-', tag.tag_name)) AS TagName FROM student JOIN student_tag ON student.student_id = student_tag.student_id JOIN tag ON tag.tag_id = student_tag.tag_id GROUP BY firstname, lastname HAVING TagName like '%$otsing%'";
if(isset($_REQUEST["tag_nameinput"])){
    $sql = "SELECT student.firstname, student.lastname, GROUP_CONCAT(CONCAT(tag.tag_color, '-', tag.tag_name)) AS TagName FROM student JOIN student_tag ON student.student_id = student_tag.student_id JOIN tag ON tag.tag_id = $_REQUEST[tag_nameinput] GROUP BY firstname, lastname";
}
$result = mysqli_query($conn, $sql);
?>


<html>
<head>
<title>Sildid</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<form name="frmStudents" method="post" action="">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<div align="right" style="padding-bottom:5px;"><a href="Student.php" class="link"><img alt='List' title='List' src='images/list.png' width='15px' height='15px'/> Tudengid</a></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="listheader">
<td>Eesnimi</td>
<td>Perenimi</td>
<td>Silt</td>
</tr>

<body>

      <form action="GetTag.php" method="GET">
        Search: <input type="text" name="otsing" /><br />
      <input type="submit" name="submit" value="Submit" />
      </form>

</body>


<?php

$i=0;
while($row = mysqli_fetch_array($result)) {
    if($i%2==0)
    $classname="evenRow";
    else
    $classname="oddRow";

?>

<tr class="<?php if(isset($classname)) echo $classname;?>">

    <td><?php echo $row["firstname"]; ?></td>
    <td><?php echo $row["lastname"]; ?></td>
    <td>

       <?php
         $m=explode(",",$row["TagName"] );
         foreach($m as $rida) {
             $paar=explode("-", $rida);
             echo "<span style='background-color: $paar[0]'>$paar[1]</span>";
         }
       ?>
    
    </td>

</tr>

<?php
$i++;
    }
?>

</table>
</div>
</form>
</body></html> 
