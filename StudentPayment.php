<?php
require("Session/session.php");
require("FNC/fnc_StudentWithFilter.php");
require("config.php");
$chosed = "";
require("Webpiece/Htmlheader.php");
echo "\n \t".'<link rel="stylesheet" type="text/css" media="screen" href="Styles/studentsStyle.css">'."\n";
require("Webpiece/Dropdown.php");
?>

<div class="student-table">
    <h2>Tudengid</h2>
    <br>
    <?php
        echo getTagStudentPayment($chosed);
    ?>

</div>


<?php
require("Webpiece/Footer.php");
?>